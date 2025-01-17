<?php

namespace App\Livewire\Admin\Chef;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Chef;
use Livewire\Attributes\Layout;

class ChefIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $delId;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $chefs = Chef::paginate(10);
        return view('livewire.admin.chef.chef-index', compact('chefs'));
    }

    public function getDelId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        Chef::findOrFail($this->delId)->delete();
        $this->dispatch('closeModal');
        toastr()->error(__('Chef deleted successfully'));
    }
}
