<?php

namespace App\Livewire\Admin\Category;

use App\Models\Catagory;
use App\Models\WcuSection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryIndexComponent extends Component
{

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $categories = Catagory::orderBy('order', 'asc')->get();
        return view('livewire.admin.category.category-index-component', compact('categories'));
    }

    public function destroy()
    {
        $item = WcuSection::findOrFail($this->delId);
        $item->delete();
        $this->dispatch('closeModal');
        toastr()->error('Deleted!');
    }

    public function deleteId($id)
    {
        $this->delId = $id;
    }
}
