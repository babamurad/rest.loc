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

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $banners = '';// Banner::paginate(10);

        return view('livewire.admin.banner.banner-index', ['banners' => $banners]);
    }
}
