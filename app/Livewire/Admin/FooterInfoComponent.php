<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\FooterInfo;
use Livewire\WithFileUploads;
use Carbon\Carbon;

#[Title('Footer Info')]
class FooterInfoComponent extends Component
{
    use WithFileUploads;
    public $logo = 'assets/images/logo.png';
    public $newlogo;
    public $short_info;
    public $address;
    public $phone;
    public $email;
    public $copyright;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $footer_info = FooterInfo::find(1);
        return view('livewire.admin.footer-info-component', compact('footer_info'));
    }

    public function mount()
    {
        $footer_info = FooterInfo::find(1);
        if ($footer_info) {
            $this->short_info = $footer_info->short_info;
            $this->address = $footer_info->address;
            $this->phone = $footer_info->phone;
            $this->email = $footer_info->email;
            $this->logo = $footer_info->logo;
            $this->copyright = $footer_info->copyright;
        }
    }

    public function updateFooterInfo()
    {
        $this->validate([
            'short_info' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            // 'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            // 'newlogo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);

        $footer_info = FooterInfo::find(1);
        if (!$footer_info) {
            $footer_info = new FooterInfo();
            $footer_info->id = 1;
            
            $imageName = 'uploads/footer/' . Carbon::now()->timestamp.'.'.$this->newlogo->extension();
            $this->newlogo->storeAs($imageName);
            $footer_info->logo = $imageName;

            $footer_info->short_info = $this->short_info;
            $footer_info->address = $this->address;
            $footer_info->phone = $this->phone;
            $footer_info->email = $this->email;
            $footer_info->logo = $this->logo;
            $footer_info->copyright = $this->copyright;
            $footer_info->save();
        } else {
            $footer_info->short_info = $this->short_info;
            $footer_info->address = $this->address;
            $footer_info->phone = $this->phone;
            $footer_info->email = $this->email;
            if ($this->newlogo) {
                if (file_exists('uploads/footer/' . $this->logo)) {
                    unlink('uploads/footer/' . $this->logo);
                }
                $imageName = 'uploads/footer/' . Carbon::now()->timestamp.'.'.$this->newlogo->extension();
                $this->newlogo->storeAs($imageName);
                $footer_info->logo = $imageName;
            }
            $footer_info->copyright = $this->copyright;
            $footer_info->update();
        }
        toastr()->success(__('Footer info updated successfully'));
    }

}
