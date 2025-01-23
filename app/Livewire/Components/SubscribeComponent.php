<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Subscriber;

class SubscribeComponent extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.components.subscribe-component');
    }

    public function subscribe()
    {
        try {
            $validatedData = $this->validate([
                'email' => 'required|email|unique:subscribers'
            ], [
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
                'email.unique' => 'The email has already been taken.'
            ]);

            $subscriber = new Subscriber();
            $subscriber->email = $this->email;
            $subscriber->save();
            toastr()->success(__('You have successfully subscribed to our newsletter!'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->errors() as $error) {
                toastr()->error($error[0]);
            }
        } catch (\Exception $e) {
            toastr()->error(__('Something went wrong! Please try again.'));
        }
    }
}
