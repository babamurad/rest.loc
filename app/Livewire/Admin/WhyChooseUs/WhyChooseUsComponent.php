<?php

namespace App\Livewire\Admin\WhyChooseUs;

use App\Models\WhyChooseUs;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WhyChooseUsComponent extends Component
{

    public $title;
    public $top_title;
    public $sub_title;

    protected $rules = [
        'title' => 'required|max:255',
        'top_title' => 'required|max:255',
        'sub_title' => 'required|max:255',
    ];

    public function delete()
    {
        $this->dispatch('closeModal');
        toastr()->error('Deleted!');
        //dd('delete');
    }

    public function saveTitle()
    {
        $this->validate();
        WhyChooseUs::where('key', 1)->update([
            'title' => $this->title,
            'top_title' => $this->top_title,
           'sub_title' => $this->sub_title,
        ]);
        toastr()->success('Заголовки сохранены');
    }

    public function mount()
    {
        $titles = WhyChooseUs::where('key', 1)->first();
        $this->title = $titles->title;
        $this->top_title = $titles->top_title;
        $this->sub_title = $titles->sub_title;
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $chooses = '';
        return view('livewire.admin.why-choose-us.why-choose-us-component', compact('chooses'));
    }
}
