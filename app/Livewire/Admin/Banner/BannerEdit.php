<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Banner;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

class BannerEdit extends Component
{
    use WithFileUploads;
    public $image = '';
    public $newimage;
    public $idEdit;
    public $title;
    public $sub_title;
    public $link = '';
    public $status;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.banner.banner-edit');
    }

    public function mount($id)
    {
        $banner = Banner::findOrFail($id);
        $this->idEdit = $banner->id;
        $this->title = $banner->title;
        $this->sub_title = $banner->sub_title;
        $this->link = $banner->link;
        $this->status = $banner->status;
        $this->image = $banner->image;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            // 'link' => 'required|url',
            'status' => 'required',
            'newimage' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        ]);

        $banner = Banner::findOrFail($this->idEdit);
        $banner->title = $this->title;
        $banner->sub_title = $this->sub_title;
        $banner->link = $this->link?? '';
        $banner->status = $this->status;
        if ($this->newimage){
            if (file_exists('uploads/banners/'.$this->image)){
                unlink('uploads/banners/' . $this->image);
            }
            $imageName = 'uploads/banners/' . Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs($imageName);
            $banner->image = $imageName;
        }
        $banner->update();
        toastr()->success(__('Banner updated successfully'));
        $this->redirect(route('admin.banner'), navigate:true);
    }

    public function cancel()
    {
        $this->reset(['image', 'title', 'sub_title', 'link', 'status'  ] );
        $this->redirect(route('admin.banner'), navigate:true);
    } 
}
