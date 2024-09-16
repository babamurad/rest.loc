<?php

namespace App\Livewire\Admin\Category;

use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Category;

class CategoryCreateComponent extends Component
{
    public $name;
    public $slug;
    public $status = 1;
    public $order = 0;
    public $show_at_home = 1;

    protected $rules = [
        'name' => ['required','string','max:255'],
        'slug' => ['required','string','max:255','unique:categories,slug'],
    ];

    public function createCategory()
    {
        $this->validate();
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->status = $this->status;
        $category->order = $this->order;
        $category->show_at_home = $this->show_at_home;
        $category->save();
        $this->reset(['name','slug','status','order','show_at_home']);
        toastr()->success('Category created successfully!');
        return redirect()->route('admin.category.index');
    }

    public function cancel()
    {
        $this->reset(['name','slug','status','order','show_at_home']);
        $this->redirect(route('admin.categories.index'), navigate:true);
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.category.category-create-component');
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }
}
