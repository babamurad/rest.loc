<?php

namespace App\Livewire\Pages;

use App\Mail\Contact;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

#[Title('Contact')]
class ContactComponent extends Component
{
    public $name;
    public $email;
    public $phone;
    public $messageSubject;
    public $messageText;

    public function render()
    {
        return view('livewire.pages.contact-component');
    }

    public function sendContactForm()
    {
        try {
            // Сначала валидация
            $validated = $this->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'messageSubject' => 'required',
                'messageText' => 'required',
            ]);

            Log::info('Validated data:', $validated);

            // Получаем email администратора
            $adminEmail = config('mail.admin_address', 'admin@example.com');
            //dd($adminEmail);
            
            Log::info('Preparing to send email to:', ['admin_email' => $adminEmail]);

            // Создаем объект письма
            $mailObject = new Contact(
                $validated['name'],
                $validated['email'],
                $validated['phone'],
                $validated['messageSubject'],
                $validated['messageText']
            );

            // Отправляем письмо
            Mail::to($adminEmail)->send($mailObject);
            
            Log::info('Email sent successfully');
            
            // Очищаем форму
            $this->reset(['name', 'email', 'phone', 'messageSubject', 'messageText']);
            
            toastr()->success('Сообщение успешно отправлено');
            
        } catch (\Exception $e) {
            Log::error('Full error details:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            toastr()->error('Произошла ошибка при отправке сообщения');
        }
    }

    public function validateName()
    {
        $this->validate(['name' => 'required'], ['name.required' => 'Name is required']);
    }

    public function validateEmail()
    {
        $this->validate(['email' => 'required|email'], ['email.required' => 'Email is required', 'email.email' => 'Email is not valid']);
    }

    public function validatePhone()
    {
        $this->validate(['phone' => 'required'], ['phone.required' => 'Phone is required']);
    }

    public function validateSubject()
    {
        $this->validate(['messageSubject' => 'required'], ['messageSubject.required' => 'Subject is required']);
    }

    public function validateMessage()
    {
        $this->validate(['messageText' => 'required'], ['messageText.required' => 'Message is required']);
    }

    public function resetForm()
    {
        $this->reset();
    }
}
