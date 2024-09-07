<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminProfileComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $email;
    public $image, $newimage;

    public $password;
    public $current_password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|max:200|unique:users,email,' . auth()->user()->id,
        ];
    }

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->image = auth()->user()->avatar;
    }

    public function updateUser()
    {
        $validated = $this->validate();  // Попытка валидации
        // Если валидация успешна
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
        }

        $user->name = $this->name;
        $user->email = $this->email;
        $user->update();
        $this->dispatch('avatar-changed');
        flash()->success('User name and email has been updated!');
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:6|confirmed',
            'current_password' => 'required|current_password',
        ]);

        $user = User::FindOrFail(auth()->user()->id)->first();
        $user->update([
            'password' => $this->password,
        ]);
        flash()->success('User password has been updated!');
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.admin-profile-component');
    }
}
