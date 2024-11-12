<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductSize;
use Cart;
use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\Renderless;

class FoodMenuComponent extends Component
{
    public $product;
    public $isLoading = false;
    public $closeModal = false;
    public $totalSummary = 0;

    public function render()
    {
        //hren blyaty с этим компонентом, с отображенем модального окна и фудменю блять пиздец нахуй
        // Fetch categories and products
        $categories = Category::where('status', 1)->get();
        $products = Product::with('category')->where('show_at_home', 1)->orderBy('id', 'desc')->take(12);//where('status', 1)->
//        ->where('status', 1)
        $setting = Setting::where('key', 'currency_icon')->first();

        // Return the view with categories and products
        return view('livewire.components.food-menu-component', compact('categories', 'products', 'setting'));
    }

    public function mount()
    {
        $this->product = Product::with('sizes', 'options')->first();
    }

    public function getProduct($id)
    {
        $this->dispatch('loading-product');
        $this->isLoading = true;
        $this->product = Product::with('sizes', 'options')->findOrFail($id);
        $this->isLoading = false;
        $this->closeModal = false;
        $this->dispatch('product-loaded');
        $this->dispatch('show-modal');
    }

    public function addToCart($id, $count, $summa, $sizeId, $sizeName, $sizePrice, $checkedOptions)
    {
        try {
            //Cart::instance('wishlist')->add('sdjk922', 'Product 2', 1, 19.95, 550, ['size' => 'medium']);
            $product = Product::with('sizes', 'options')->findOrFail($id);
            $productOptions = $product->options->whereIn('id', $checkedOptions);

            $options = [
                'row_info' => [
                    'rowTotal' => $summa
                ],
                'product_size' => [],
                'product_options' => [],
                'product_info' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'offer_price' => $product->offer_price,
                    'discount' => $product->discount,
                    'short_description' => $product->short_description,
                    'long_description' => $product->long_description,
                    'image' => $product->thumb_image,
                    'sku' => $product->sku,
                    'quantity' => $count,
                    'total_price' => $summa,
                    'total_weight' => 0,
                    'category_id' => $product->category_id,
                    'category_name' => $product->category->name,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                    'is_featured' => $product->is_featured,
                    'show_at_home' => $product->show_at_home,
                    'status' => $product->status,
                ]
            ];
// Size option can be empty
            $options['product_size'] = [
                'id' => $sizeId ?? null,
                'name' => $sizeName ?? null,
                'price' => $sizePrice ?? 0,
            ];
// Product options can be empty
            if ($productOptions->count() > 0) {
                foreach ($productOptions as $option) {
                    $options['product_options'][] = [
                        'id' => $option->id,
                        'name' => $option->name,
                        'price' => $option->price,
                    ];
                }
            }

            //instance('cart')->
            //weight using as rowTotal
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $count,
                'price' => $product->offer_price > 0 ? $product->offer_price : $product->price,
                'weight' => $summa,
                'options' => $options,
            ]);
            //$this->closeModal = true;
            //$this->dispatch('cart-updated');
            //session()->flash('success', __('Product has been added to cart!'));
            $this->dispatch('close-modal');
            //$this->dispatch('clear-options');
            $this->dispatch('Product_added_to_cart');
            toastr()->success(__('Product has been added to cart!'));
        } catch (\Exception $e) {
            //toastr()->error(__('Something went worng!'));
            $this->dispatch('error_message');
        }
    }
}
