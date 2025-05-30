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
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Product')]
class ProductEditComponent extends Component
{
    use WithFileUploads;
    public $product;
    public $editId;
    public $name, $slug, $thumb_image, $newimage, $category_id;
    public $price, $offer_price, $quantity, $short_description, $long_description;
    public $sku, $status, $is_featured, $show_at_home, $seo_title, $seo_description;
    public $images, $newimages;

    public $sizeName;
    public $optionName;
    public $sizePrice;
    public $optionPrice;

    public $size_id, $option_id;
    public $sizeEdit = false;
    public $optionEdit = false;

    protected $rules = [
        'name' => ['required','string','max:255'],
        'slug' => ['required','string','max:255','unique:categories,slug'],
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
    ];

    public function cancel()
    {
        $this->reset(['name','slug','status','show_at_home']);
        return $this->redirect(route('admin.product.index'), navigate:true);
    }

    public function delImageItem($key)
    {
        $product = Product::find($this->editId);
        $images = explode(',', $product->images);
        //dd($images[$id]);
        $img = $images[$key];//название файла которое нужно удалить
        unset($images[$key]);//удалить название выбранного изображение с поля таблицы images
        if (file_exists('uploads/products/' . $img)) {
            // Удалить файл если существует
            unlink('uploads/products/' . $img);
        }
        $imeNames = '';
        foreach ($images as $image) {
            $imeNames = $imeNames . ',' . $image;
        }
        $product->images = $imeNames;

        $product->update();
        $this->images = explode(',', $imeNames);
        toastr()->error('Image has been removed.');
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
            if (file_exists('uploads/products/'.$this->thumb_image)){
                unlink('uploads/products/' . $this->thumb_image);
            }
            $imageName ='uploads/products/' . Carbon::now()->timestamp.'.'.$this->newimage->getClientOriginalName();
            $this->newimage->storeAs($imageName);
            $product->thumb_image = $imageName;
        }

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

        if ($this->newimage) {
            if (file_exists('uploads/products/' . $this->editId)) {
                try {
                    //unlink('uploads/products/' . $this->editId . '/' . $this->thumb_image);
                } catch (Exception $e) {
                    // Handle the exception, e.g., log the error or display a user-friendly message
                    //error_log("Error deleting thumbnail image: " . $e->getMessage());
                }finally {
                    // Закрыть соединение с базой данных или выполнить другие действия
                    $imageName = 'uploads/products/' . $this->editId . '/' . Carbon::now()->timestamp . '-' . $this->newimage->getClientOriginalName();
                    $this->newimage->storeAs($imageName); // Use $this->newimage, not $this->thumb_image
                    $product->thumb_image = $imageName;
                }
            }


        }


        if ($this->newimages)
        {
            $iamgesName = '';
            foreach ($this->newimages as $key=>$image)
            {
                $imageName = 'uploads/products/' . $this->editId . '/' . Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs($imageName);
                if ($iamgesName == '')
                {
                    $iamgesName = $imageName;
                } else { $iamgesName =$iamgesName . ',' . $imageName; }

            }
            $product->images = $iamgesName;
        }
        $product->update();

        $this->reset(['name','slug','status','show_at_home']);
        toastr()->success('Product has been updated.');
        return redirect()->route('admin.product.index');
    }

    public function saveSize()
    {
        $this->validate([
            'sizeName' => ['required', 'string'],
            'sizePrice' => ['required', 'numeric', 'min:0'],
        ]);

        // Находим или создаем объект Size
        $size = $this->sizeEdit ? ProductSize::find($this->size_id) : new ProductSize();

        // Заполняем свойства объекта
        $size->product_id = $this->product->id;
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
        $option = $this->optionEdit ? ProductOption::find($this->option_id) : new ProductOption();

        // Заполняем свойства объекта
        $option->product_id = $this->product->id;
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

    public function destroySize($size_id)
    {
        try {
            $size = ProductSize::findOrFail($size_id)->delete();
            toastr()->error(__('Option has been deleted.'));
        } catch (\Exception $e) {
            toastr()->error(__('Failed to delete option.'));
        }
    }

    public function destroyOption($option_id)
    {
        try {
            $option = ProductOption::findOrFail($option_id)->delete();
            toastr()->error(__('Option has been deleted.'));
        } catch (\Exception $e) {
            toastr()->error(__('Failed to delete option.'));
        }
    }

    public function editSize($size_id)
    {
        $size = ProductSize::findOrFail($size_id);
        $this->size_id = $size->id;
        $this->sizeName = $size->name;
        $this->sizePrice = $size->price;
        $this->sizeEdit = true;
    }

    public function editOption($option_id)
    {
        $option = ProductOption::findOrFail($option_id);
        $this->option_id = $option->id;
        $this->optionName = $option->name;
        $this->optionPrice = $option->price;
        $this->optionEdit = true;
    }

    public function mount($id)
    {
        $this->editId = $id;
        $product = Product::find($this->editId);
        $this->product = $product;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->thumb_image = $product->thumb_image;
        $this->price = $product->price;
        $this->offer_price = $product->offer_price;
        $this->quantity = $product->quantity;
        $this->short_description = $product->short_description;
        $this->long_description = $product->long_description;
        $this->category_id = $product->category_id; // используйте id категории
        $this->images = explode(',', $product->images);
        //$categoryName = Category::find($this->category_id)->name; // Либо используйте имя категории

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
        $categories = Category::all();

        return view('livewire.admin.product.product-edit-component', compact('categories'));
    }
}
