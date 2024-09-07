<?php

namespace App\Livewire\Dashboard;

use App\Models\Phone;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    public $name;
    public $email, $phone;

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ];
    }

    public function render()
    {
        return view('livewire.dashboard.profile');
    }

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        if (auth()->user()->phone) {
            $this->phone = auth()->user()->phone->phone;
        } else {
            $this->phone = '';
        }

    }

    public function cancel()
    {
        $this->mount();
    }

    public function updateUser()
    {
        $this->validate();

        $user = User::FindOrFail(auth()->user()->id);
        /*if ($this->newimage){
            if (file_exists('images/' . $user->avatar)) {
                try {
                    unlink('images/' . $user->avatar);
                } catch (Exception $ex){

                };
            }
            $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();

            $this->newimage->storeAs($imageName);
            $user->avatar = $imageName;
        }*/

            $phone = Phone::where('user_id', auth()->user()->id)->first();
            if (!$phone) {
                $phone = new Phone();
                $phone->user_id = auth()->user()->id;
                $phone->phone = $this->phone;
                $phone->save();
            } else {
                $phone->user_id = auth()->user()->id;
                $phone->phone = $this->phone;
                $phone->update();
            }

        $user->name = $this->name;
        $user->email = $this->email;
        $user->update();
        $this->dispatch('avatar-changed');
        flash()->success('User data has been updated successfully!');
    }
}
