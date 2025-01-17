<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Banner;
use Livewire\Attributes\Layout;

class BannerIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $delId;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $banners = Banner::paginate(8);

        return view('livewire.admin.banner.banner-index', ['banners' => $banners]);
    }

    public function getDelId($id) 
    {
        $this->delId = $id;
    }

    public function destroy() 
    {
        Banner::findOrFail($this->delId)->delete();
        $this->dispatch('closeModal');
        toastr()->error(__('Banner deleted successfully'));
    }

    public function ActInact($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = !$banner->status;
        $banner->save();
    }
}
