<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductSize;
use App\Models\TempOption;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Create Product')]
class ProductCreateComponent extends Component
{
    use WithFileUploads;

    public $name, $slug, $thumb_image, $category_id;
    public $price, $offer_price, $quantity, $short_description, $long_description;
    public $sku, $status, $is_featured, $show_at_home, $seo_title, $seo_description;
    public $images;
    public $productId;
    #[Rule(['required', 'string'])]
    public $sizeName;
    #[Rule(['required','string'])]
    public $optionName;
    #[Rule(['required','numeric','min:0'])]
    public $sizePrice;
    #[Rule(['required','numeric','min:0'])]
    public $optionPrice;

    public $size_id, $option_id;
    public $sizeEdit = false;
    public $optionEdit = false;


    /*protected $rules = [
        'name' => ['required','string','max:255'],
        'slug' => ['required','string','max:255','unique:products,slug'],
        'thumb_image' => ['required', 'image', 'max:2048']
    ];*/

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
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'], //, 'unique:products,slug'
            /*'thumb_image' => ['required', 'image', 'max:2048'],
            'price' => ['required', 'numeric','min:0'],
            'offer_price' => ['nullable', 'numeric','min:0'],
            'quantity' => ['required', 'numeric','min:0'],
            'short_description' => ['required','max:500'],
            'long_description' => ['required'],
            'category_id' => ['required', 'integer'],
            'seo_title' => ['nullable', 'max:255'],
            'sku' => ['nullable', 'max:255'],
            'show_at_home' => ['boolean'],
            'status' => ['requires', 'boolean']*/
        ]);

        //dd('validate');
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->thumb_image = 'uploads/products/placeholder.jpg';

        $product->price = $this->price;
        $product->offer_price = $this->offer_price;
        $product->quantity = $this->quantity;
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

        $this->productId = $product->id;

        $imageName ='uploads/products/' . $this->productId . '/' . Carbon::now()->timestamp.'-'.$this->thumb_image->getClientOriginalName();
        $this->thumb_image->storeAs($imageName);
        $product->thumb_image = $imageName;

        if ($this->images)
        {
            $iamgesName = '';
            foreach ($this->images as $key=>$image)
            {
                $imageName = 'uploads/products/' . $this->productId . '/' . Carbon::now()->timestamp.$key.'.'.$image->extension();
                $image->storeAs($imageName);
                if ($iamgesName == '')
                {
                    $iamgesName = $imageName;
                } else { $iamgesName =$iamgesName.','. $imageName; }

            }
            $product->images = $iamgesName;
        }

        $sizes = TempOption::where('temp_id', 1)->get();

        $productSizes = $sizes->map(function ($size) {
            return [
                'product_id' => $this->productId,
                'name' => $size->name,
                'price' => $size->price,
            ];
        })->toArray(); // Added missing closing parenthesis for the map function

        ProductSize::insert($productSizes);

        $options = TempOption::where('temp_id', 2)->get();

        $productOptions = $options->map(function($option) {
            return [
                'product_id' => $this->productId,
                'name' => $option->name,
                'price' => $option->price,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        ProductOption::insert($productOptions);

        $product->update();

        $this->reset(['name','slug','status', 'show_at_home']);
        toastr()->success('Product has been added.');
        return redirect()->route('admin.product.index');
    }

    public function saveSize()
    {
        $this->validate([
            'sizeName' => ['required', 'string'],
            'sizePrice' => ['required', 'numeric', 'min:0'],
        ]);

        // Находим или создаем объект Size
        $size = $this->sizeEdit ? TempOption::find($this->size_id) : new TempOption();

        // Заполняем свойства объекта
        $size->temp_id = 1;
        $size->name = $this->sizeName;
        $size->price = $this->sizePrice;

        // Обновляем или создаем запись
//        $this->sizeEdit ? $size->update() : $size->save();
        $size->save();

        // Отображаем сообщение об успешном действии
        toastr()->success($this->sizeEdit ? __('Size has been updated.') : __('Size has been added.'));

        $this->sizeName = '';
        $this->sizePrice = '';
        $this->sizeEdit = false;
    }

    public function saveOption()
    {
        $this->validate([
           'optionName' => ['required','string'],
           'optionPrice' => ['required','numeric','min:0']
        ]);

        // Находим или создаем объект Size
        $option = $this->optionEdit ? TempOption::find($this->option_id) : new TempOption();

        // Заполняем свойства объекта
        $option->temp_id = 2;
        $option->name = $this->optionName;
        $option->price = $this->optionPrice;

        // Обновляем или создаем запись
//        $this->$this->optionEdit ? $option->update() : $option->save();
        $option->save();

        // Отображаем сообщение об успешном действии
        toastr()->success($this->optionEdit ? __('Option has been updated.') : __('Option has been added.'));

        $this->optionName = '';
        $this->optionPrice = '';
        $this->optionEdit = false;
    }

    public function editSize($size_id)
    {
        $size = TempOption::findOrFail($size_id);
        $this->size_id = $size->id;
        $this->sizeName = $size->name;
        $this->sizePrice = $size->price;
        $this->sizeEdit = true;
    }

    public function deleteSize($size_id)
    {
        $size = TempOption::findOrFail($size_id);
        $this->size_id = $size->id;
    }

    public function deleteOption($option_id)
    {
         $option = TempOption::findOrFail($option_id);
         $this->option_id = $option->id;
    }

    public function editOption($option_id)
    {
         $option = TempOption::findOrFail($option_id);
         $this->option_id = $option->id;
         $this->optionName = $option->name;
         $this->optionPrice = $option->price;
         $this->optionEdit = true;
    }

    public function destroySize($size_id)
    {
        $size = TempOption::findOrFail($size_id);
        $this->size_id = $size->id;
        try {
            $size = TempOption::findOrFail($this->size_id)->delete();
            //$this->dispatch('closeModalSize');
            toastr()->error(__('Option has been deleted.'));
        } catch (\Exception $e) {
            toastr()->error(__('Failed to delete option.'));
        }
    }

    public function destroyOption($option_id)
        {
            $option = TempOption::findOrFail($option_id);
            $this->option_id = $option->id;
            try {
                $option = TempOption::findOrFail($this->option_id)->delete();
                $this->dispatch('closeModalOption');
                toastr()->error(__('Option has been deleted.'));
            } catch (\Exception $e) {
                toastr()->error(__('Failed to delete option.'));
            }
        }

    public function mount()
    {
        TempOption::truncate();
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $sizes = TempOption::where('temp_id', 1)->get();
        $options = TempOption::where('temp_id', 2)->get();
        $categories = Category::all();
        return view('livewire.admin.product.product-create-component', compact('categories', 'sizes', 'options'));
    }
}
