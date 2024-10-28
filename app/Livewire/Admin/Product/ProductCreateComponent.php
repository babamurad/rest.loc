<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Create Product')]
class ProductCreateComponent extends Component
{
    use WithFileUploads;

    public $name, $slug, $thumb_image, $category_id;
    public $price, $offer_price, $short_description, $long_description;
    public $sku, $status, $is_featured, $show_at_home, $seo_title, $seo_description;
    public $images;
    public $activeTab = 'main';


    protected $rules = [
        'name' => ['required','string','max:255'],
        'slug' => ['required','string','max:255','unique:products,slug'],
        'thumb_image' => ['required', 'image', 'max:2048']
    ];

    public function changeTab($tabName)
    {
        $this->activeTab = $tabName;
    }

    public function cancel()
    {
        $this->reset(['name','slug','status', 'show_at_home']);
        $this->redirect(route('admin.product.index'), navigate:true);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function generateSKU()
    {
        $categoryName = Category::find($this->category_id)->name;
        return $this->sku = strtoupper(substr($categoryName, 0, 3)) . '-' . strtoupper(substr($this->name, 0, 3)) . '-' . strtoupper(substr($this->price, 0, 5));
    }

    public function updatedPrice()
    {
        $this->generateSKU();
    }

    public function updatedName()
    {
        $this->generateSKU();
    }

    public function updatedCategoryId()
    {
        $this->generateSKU();
    }

    public function delImageItem($key)
    {
        unset($this->images[$key]);
        toastr()->error('Image has been removed.');
    }

    public function createProduct()
    {
        $this->validate();
        //dd('validate');
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->thumb_image = 'uploads/products/placeholder.jpg';

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

        $productId = $product->id;

        $imageName ='uploads/products/' . $productId . '/' . Carbon::now()->timestamp.'-'.$this->thumb_image->getClientOriginalName();
        $this->thumb_image->storeAs($imageName);
        $product->thumb_image = $imageName;

        if ($this->images)
        {
            $iamgesName = '';
            foreach ($this->images as $key=>$image)
            {
                $imageName = 'uploads/products/' . $productId . '/' . Carbon::now()->timestamp.$key.'.'.$image->extension();
                $image->storeAs($imageName);
                if ($iamgesName == '')
                {
                    $iamgesName = $imageName;
                } else { $iamgesName =$iamgesName.','. $imageName; }

            }
            $product->images = $iamgesName;
        }

        $product->update();

        $this->reset(['name','slug','status', 'show_at_home']);
        toastr()->success('Product has been added.');
        return redirect()->route('admin.product.index');
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.product.product-create-component', compact('categories'));
    }
}
