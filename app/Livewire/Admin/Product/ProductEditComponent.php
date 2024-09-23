<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEditComponent extends Component
{
    use WithFileUploads;
    public $editId;
    public $name, $slug, $image, $newimage, $category_id;
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

    public function generateSKU($category, $name, $price)
    {
        return strtoupper(substr($category, 0, 3)) . '-' . strtoupper(substr($name, 0, 3)) . '-' . strtoupper(substr($price, 0, 3));
    }

    public function updateProduct()
    {
        $this->validate();

        $product = Product::find($this->editId);
        $product->name = $this->name;
        $product->slug = $this->slug;

        if ($this->newimage){
            if (file_exists('uploads/products/'.$this->image)){
                unlink('uploads/products/' . $this->image);
            }
            $imageName ='uploads/products/' . Carbon::now()->timestamp.'.'.$this->newimage->getClientOriginalName();
            $this->newimage->storeAs($imageName);
            $product->thumb_image = $imageName;
        }

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
        toastr()->success('Product has been added.');
        return redirect()->route('admin.product.index');
    }

    public function mount($id)
    {
        $this->editId = $id;
        $product = Product::find($this->editId);
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->image = $product->thumb_image;
        $this->price = $product->price;
        $this->offer_price = $product->offer_price;
        $this->short_description = $product->short_description;
        $this->long_description = $product->long_description;
        $this->category_id = $product->category_id; // используйте id категории

        $categoryName = Category::find($this->category_id)->name; // Либо используйте имя категории

        $this->status = $product->status;
        $this->sku = $product->sku;
        $this->is_featured = $product->is_featured;
        $this->show_at_home = $product->show_at_home;
        $this->seo_title = $product->seo_title;
        $this->seo_description = $product->seo_description;
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.product.product-edit-component');
    }
}
