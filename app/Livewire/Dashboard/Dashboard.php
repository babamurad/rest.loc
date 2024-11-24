<?php

namespace App\Livewire\Dashboard;

use App\Models\DeliveryArea;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;


#[Title('User Dashboard')]
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

        $user = User::FindOrFail(auth()->user()->id);

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

            $user->update();
            flash()->success('User data has been updated successfully!');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        // return redirect()->route('/');
        return $this->redirect('/login', navigate:true);
    }

    public function cancel()
    {
        $this->reset();
    }

    public function render()
    {
        $areas = DeliveryArea::where('status', 1)->orderBy('area_name', 'asc')->get();
        //$adresses = \App\Models\Address::where('user_id', auth()->user()->id)->with('deliveryArea')->get();
        return view('livewire.dashboard.dashboard', compact('areas'));
    }
}
