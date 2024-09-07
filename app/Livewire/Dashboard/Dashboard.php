<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use WithFileUploads;
    public $image;
    public $newimage;

    public function mount()
    {
        $this->image = auth()->user()->avatar;
    }

    public function updatedNewimage()
    {
//        $this->validate([
//            'newimage' => 'image'
//        ]);

        $user = User::FindOrFail(auth()->user()->id)->first();
        if ($this->newimage){
            if (file_exists('images/' . $user->avatar)) {
                try {
                    unlink('images/' . $user->avatar);
                } catch (Exception $ex){

                };
            }
            $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();

            $this->newimage->storeAs($imageName);
            $user->avatar = $imageName;
//            dd( $user->avatar);
            $user->update();
            flash()->success('User data has been updated successfully!');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
