<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
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


    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.product.product-create-component', compact('categories'));
    }
}
