<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

class BannerCreate extends Component
{
    use WithFileUploads;
    public $image = '';
    public $title;
    public $sub_title;
    public $link = '';
    public $status;



    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.banner.banner-create');
    }

    public function create()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            // 'link' => 'required|url',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = 'uploads/banners/' . Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs($imageName);
        $banner = new Banner();
        $banner->title = $this->title;
        $banner->sub_title = $this->sub_title;
        $banner->link = $this->link?? '';
        $banner->status = $this->status;
        $banner->image = $imageName;
        $banner->save();
        $this->reset(['image', 'title', 'sub_title', 'link', 'status'  ] );
        toastr()->success(__('Banner created successfully'));
        $this->redirect(route('admin.banner'), navigate:true);
    }

    public function cancel()
    {
        $this->reset(['image', 'title', 'sub_title', 'link', 'status'  ] );
        $this->redirect(route('admin.banner'), navigate:true);
    }    
}
