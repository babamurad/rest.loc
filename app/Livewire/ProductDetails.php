<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use Cart;

class ProductDetails extends Component
{
    public $product;
    public $imagePaths;
    public $reProduct;
    public $closeModal = false;

    protected $listeners = [
        'some-event' => '$refresh'
    ];

    public function render()
    {
        $setting = Setting::where('key', 'currency_icon')->first();
        $relatedProducts = Product::where('category_id', $this->product->category_id)->where('id', '!=', $this->product->id)->with('category')->take(8)->latest()->get();
        return view('livewire.product-details', compact('relatedProducts', 'setting'));
    }

    public function mount($slug)
    {
        $this->reProduct = Product::with('sizes', 'options')->first();
        $this->product = Product::with('sizes', 'options')->where('slug', $slug)->firstOrFail();
        $imagesString = $this->product->images; // Или другой способ получить значение
        $this->imagePaths = explode(',', $imagesString);
//        dd($this->imagePaths);
        if (!$this->product) {
            abort(404);
        }
    }

    public function addToCart($id, $count, $summa, $sizeId, $sizeName, $sizePrice, $checkedOptions)
    {
        try {
            //Cart::instance('wishlist')->add('sdjk922', 'Product 2', 1, 19.95, 550, ['size' => 'medium']);
            $product = Product::with('sizes', 'options')->findOrFail($id);
            $productOptions = $product->options->whereIn('id', $checkedOptions);

            $options = [
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
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => $count,
                'price' => $product->offer_price > 0 ? $product->offer_price : $product->price,
                'weight' => 0,
                'options' => $options,
            ]);
            $this->closeModal = true;
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
            //$this->render();

//        $this->redirect('product-details', ['slug' => $product->slug], [navigate:true]);

        return redirect()->route('product-details', ['slug' => $product->slug]);
    }

    public function getProduct($id)
    {
        $this->reProduct = Product::with('sizes', 'options')->findOrFail($id);
        $this->closeModal = false;
        $this->dispatch('product-loaded');
        $this->dispatch('show-modal');
    }

}
