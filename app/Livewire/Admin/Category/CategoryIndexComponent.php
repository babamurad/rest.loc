<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\WcuSection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryIndexComponent extends Component
{
    public $delId;


    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = Category::orderBy('order', 'asc')->get();
        return view('livewire.admin.category.category-index-component', compact('categories'));
    }

    public function destroy()
    {
        $item = Category::findOrFail($this->delId);
        $item->delete();
        $this->dispatch('closeModal');
        toastr()->error('Deleted!');
        return redirect()->route('admin.category.index');
    }

    public function deleteId($id)
    {
        $this->delId = $id;
    }
}
