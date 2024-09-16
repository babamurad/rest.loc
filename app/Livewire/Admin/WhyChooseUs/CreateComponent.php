<?php

namespace App\Livewire\Admin\WhyChooseUs;

use App\Models\WcuSection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateComponent extends Component
{
    public $icon = 'fas fa-hat-chef'; //'fas fa-icons';
    public $title;
    public $description;
    public $status;
    public $order;

    protected $rules = [
        'icon' => 'required',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required'
    ];

    public function createItem()
    {
        $item = new WcuSection();
        $item->icon = $this->icon;
        $item->title = $this->title;
        $item->description = $this->description;
        $item->status = $this->status;
        $item->order = $this->order;
        $item->save();
        $this->redirect(route('admin.why-choose-us'));
        toastr()->success('Item creates successfully!' );
    }

    public function cancel()
    {
        return $this->redirect(route('admin.why-choose-us'), navigate:true);
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.why-choose-us.create-component');
    }
}
