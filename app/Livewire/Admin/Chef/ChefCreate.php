<?php

namespace App\Livewire\Admin\Chef;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Chef;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

class ChefCreate extends Component
{
    use WithFileUploads;
    public $image = '';
    public $name;
    public $title;
    public $email;
    public $phone;
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
        return view('livewire.admin.chef.chef-create');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:255',
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = 'uploads/chefs/' . Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs($imageName);
        $chef = new Chef();
        $chef->name = $this->name;
        $chef->title = $this->title;
        $chef->email = $this->email;
        $chef->phone = $this->phone;
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
        $chef->image = $imageName;
        $chef->save();
        $this->reset(['image', 'name', 'title', 'email', 'phone', 'facebook', 'twitter', 'instagram', 'linkedin',
            'telegram', 'pinterest', 'tiktok', 'snapchat', 'whatsapp', 'imo', 'show_at_home', 'status']);
        toastr()->success(__('Chef created successfully'));
        $this->redirect(route('admin.chef'), navigate:true);
    }
}
