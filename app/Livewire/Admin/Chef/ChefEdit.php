<?php

namespace App\Livewire\Admin\Chef;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Chef;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ChefEdit extends Component
{
    use WithFileUploads;
    public $editId;
    public $image = '';
    public $newimage;
    public $name;
    public $title;
    public $slug;
    public $facebook;
    public $twitter;
    public $instagram;
    public $linkedin;
    public $telegram;
    public $pinterest;
    public $tiktok;
    public $snapchat;
    public $whatsapp;
    public $imo;
    public $show_at_home;
    public $status;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.chef.chef-edit');
    }

    public function mount($id)  
    {
        $chef = Chef::findOrFail($id);
        $this->editId = $chef->id;
        $this->name = $chef->name;
        $this->title = $chef->title;
        $this->image = $chef->image;
        $this->slug = $chef->slug;
        $this->facebook = $chef->facebook;
        $this->twitter = $chef->twitter;
        $this->instagram = $chef->instagram;
        $this->linkedin = $chef->linkedin;
        $this->telegram = $chef->telegram;
        $this->pinterest = $chef->pinterest;
        $this->tiktok = $chef->tiktok;
        $this->snapchat = $chef->snapchat;
        $this->whatsapp = $chef->whatsapp;
        $this->imo = $chef->imo;
        $this->show_at_home = $chef->show_at_home;
        $this->status = $chef->status;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'pinterest' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'snapchat' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'imo' => 'nullable|string|max:255',
            'show_at_home' => 'required',
            'status' => 'required',
            'newimage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $chef = Chef::findOrFail($this->editId);
        $chef->name = $this->name;
        $chef->title = $this->title;
        $chef->slug = $this->slug;
        $chef->facebook = $this->facebook;
        $chef->twitter = $this->twitter;
        $chef->instagram = $this->instagram;
        $chef->linkedin = $this->linkedin;
        $chef->telegram = $this->telegram;
        $chef->pinterest = $this->pinterest;
        $chef->tiktok = $this->tiktok;
        $chef->snapchat = $this->snapchat;
        $chef->whatsapp = $this->whatsapp;
        $chef->imo = $this->imo;
        $chef->show_at_home = $this->show_at_home;
        $chef->status = $this->status;

        if ($this->newimage) {
            $imageName = 'uploads/chefs/' . Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->image->storeAs($imageName);
            $chef->image = $imageName;
        }
        $chef->update();
        toastr()->success(__('Chef updated successfully'));
        $this->redirect(route('admin.chef'), navigate:true);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function cancel()
    {
        $this->redirect(route('admin.chef'), navigate:true);
        $this->reset(['image', 'name', 'title', 'facebook', 'twitter', 'instagram', 'linkedin',
            'telegram', 'pinterest', 'tiktok', 'snapchat', 'whatsapp', 'imo', 'show_at_home', 'status']);        
    }
}
