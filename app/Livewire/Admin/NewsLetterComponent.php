<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsLetter;

#[Title('Setting')]
class NewsLetterComponent extends Component
{
    public $search;
    public $open;
    public $subject;
    public $message;


    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $subscribes = Subscriber::paginate(10);
        return view('livewire.admin.news-letter-component', compact('subscribes'));
    }

    public function sendNewsLetter()
    {
        
        $this->validate([
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);        

        $subscribers = Subscriber::pluck('email')->toArray();

        Mail::to($subscribers)->send(new NewsLetter($this->subject, $this->message));

        // foreach ($subscribers as $subscriber) {
        //     $this->sendMail($subscriber->email, $this->subject, $this->message);
        // }

        $this->subject = '';
        $this->message = '';
        $this->open = false;
        toastr()->success(__('NewsLetter sent successfully!'));

    }
}
