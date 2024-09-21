<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndexComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $delId;

    public function deleteId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        $product = Product::findOrFail($this->delId);
        $product->delete();
        $this->dispatch('closeModal');
        toastr()->error('Deleted!');
        return redirect()->route('admin.product.index');
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $products = Product::orderBy('id', 'desc')->paginate(8);
        return view('livewire.admin.product.product-index-component', compact('products'));
    }
}
