<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryEditComponent extends Component
{
    public $editId;
    public $name;
    public $slug;
    public $status;
    public $order;
    public $show_at_home;

    protected function rules()
    {
        return [
            'name' => ['required','string','max:255', Rule::unique('categories')->ignore($this->editId)],
            'show_at_home' => ['required','boolean'],
            'status' => ['required', 'boolean'],
        ];
    }


    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.category.category-edit-component');
    }

    public function mount($id)
    {
        $category = Category::findOrfail($id);
        $this->editId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->status = $category->status;
        $this->order = $category->order;
        $this->show_at_home = $category->show_at_home;
    }

    public function cancel()
    {
        $this->reset(['name','slug','status','order','show_at_home']);
        $this->redirect(route('admin.category.index'), navigate:true);
    }

    public function update()
    {
        $this->validate();
        $category = Category::findOrFail($this->editId);
        $category->id = $this->editId;
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->status = $this->status;
        $category->order = $this->order;
        $category->show_at_home = $this->show_at_home;
        $category->update();
        $this->reset(['name','slug','status','order','show_at_home']);
        toastr()->success('Category updated successfully!');
        return redirect()->route('admin.category.index');
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }
}
