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
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $sortIcon = '<i class="fas fa-sort mr-1 text-muted"></i>';
    public $perPage = 8;
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

    public function sortType($fieldName)
    {
//        dd('sortType');
        $this->sortBy = $fieldName;
        $this->sortDirection = $this->sortDirection === 'asc'? 'desc' : 'asc';
        $this->sortIcon = $this->sortDirection === 'asc'? '<i class="fas fa-sort-up ml-1"></i>':'<i class="fas fa-sort-down ml-1"></i>';
    }

    public function updatedPerPage($value)
    {
        session(['perPage' => $value]);
    }

    public function mount()
    {
        $this->perPage = session('perPage', $this->perPage);
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $products_query = Product::query();
        if (strlen($this->search) >= 3){
            $products_query->where('name', 'LIKE', '%'.$this->search.'%');
        };

        $products = $products_query
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.product.product-index-component', compact('products'));
    }
}
