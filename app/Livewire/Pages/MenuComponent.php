<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use Cart;
use App\Models\ProductOption;
use App\Models\ProductSize;
use Livewire\Attributes\On;


class MenuComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 12;
    public $search = null;
    public $categoryId = null;
    public $categoryName = null;
    public $isOpened = false;
    public $product;
    public $isLoading = false;
    public $closeModal = false;
    public $totalSummary = 0;
    public $showModal = false;
    public $isModalOpen = false;

    public function render()
    {
        $categories = Category::with('products')->where('status', 1)->get();        
        
        $products_query = Product::query();
        if ($this->categoryId) {
            $products_query->where('category_id', $this->categoryId);
        }
        if ($this->search) {
            $products_query->where('name', 'like', '%' . $this->search . '%');
        }
        $products = $products_query
        ->with('category', 'sizes', 'options')
        ->paginate($this->perPage);

        return view('livewire.pages.menu-component', compact('categories', 'products'));
    }
    
    public function mount($id = null)
    {        
        if ($id) {
            $this->categoryId = $id;
            $this->categoryName = ucfirst(Category::find($id)->name);
        }
        $this->product = Product::with('sizes', 'options')->first();
    }

    public function selectCategory($id) 
    {
        $this->resetPage();
        $this->categoryId = $id;
        $this->categoryName = ucfirst(Category::find($id)->name);
        $this->isOpened = false;
    }

    public function resetCategory()
    {
        $this->categoryId = null;
        $this->categoryName = null;
    }

    #[On('show-product-details')]
    public function getProduct($id)
    {        
        $this->isLoading = true;
        $this->product = Product::with('sizes', 'options')->findOrFail($id);
        $this->isLoading = false; 
        $this->showModal = true;
        //dd($this->showModal);  
    }

    /**
     * Добавляет продукт в корзину.
     *
     * @param int $id
     * @param int $count
     * @param float $summa
     * @param int|null $sizeId
     * @param string|null $sizeName
     * @param float $sizePrice
     * @param array $checkedOptions
     * @return void
     */
    public function addToCart($id, $count, $summa, $sizeId, $sizeName, $sizePrice, $checkedOptions)
    {
        try {
            $product = Product::with('sizes', 'options')->findOrFail($id);
            if (number_format($product->quantity) < $count) {
                toastr()->error('Данный продукт недоступен в таком количестве. Доступно только ' . $product->quantity . ' единиц.');
            } else {
                try {
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
                    //weight using as rowTotal
                    Cart::add([
                        'id' => $product->id,
                        'name' => $product->name,
                        'qty' => $count,
                        'price' => $product->offer_price > 0 ? $product->offer_price : $product->price,
                        'weight' => $summa,
                        'options' => $options,
                    ]);
                    $this->dispatch('Product_added_to_cart');

                    $this->showModal = false;

                    toastr()->success(__('Product has been added to cart!'));
                } catch (\Exception $e) {
                    \Log::error('Ошибка при добавлении опций продукта в корзину: ' . $e->getMessage());
                    toastr()->error(__('Something went wrong!'));
                }
            }
        } catch (\Exception $e) {
            \Log::error('Ошибка при добавлении продукта в корзину: ' . $e->getMessage());
            toastr()->error(__('Something went wrong!'));
        }

    }
}
