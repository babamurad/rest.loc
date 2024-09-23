<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreateComponent extends Component
{
    use WithFileUploads;

    public $name, $slug, $thumb_image, $category_id;
    public $price, $offer_price, $short_description, $long_description;
    public $sku, $status, $is_featured, $show_at_home, $seo_title, $seo_description;

    protected $rules = [
        'name' => ['required','string','max:255'],
        'slug' => ['required','string','max:255','unique:categories,slug'],
    ];

    public function cancel()
    {
        $this->reset(['name','slug','status','order','show_at_home']);
        $this->redirect(route('admin.category.index'), navigate:true);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function generateSKU($category, $model, $color)
    {
        return strtoupper(substr($category, 0, 3)) . '-' . $model . '-' . strtoupper(substr($color, 0, 3));
    }

    public function createProduct()
    {
        $this->validate();
//        dd($this->category_id);
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->thumb_image = $this->thumb_image->store('product_thumbnails', 'public');
        $product->price = $this->price;
        $product->offer_price = $this->offer_price;
        $product->short_description = $this->short_description;
        $product->long_description = $this->long_description;
        $product->category_id = $this->category_id; // используйте id категории

        $categoryName = Category::find($this->category_id)->name; // Либо используйте имя категории
        $product->sku = $this->generateSKU($categoryName, $this->name, $this->price);

        $product->status = $this->status;
        $product->is_featured = $this->is_featured;
        $product->show_at_home = $this->show_at_home;
        $product->seo_title = $this->seo_title;
        $product->seo_description = $this->seo_description;
        $product->save();
        $this->reset(['name','slug','status', 'show_at_home']);
        toastr()->success('Produt has been added.');
        return redirect()->route('admin.product.index');
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.product.product-create-component', compact('categories'));
    }
}
