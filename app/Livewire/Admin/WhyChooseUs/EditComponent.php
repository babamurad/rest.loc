<?php

namespace App\Livewire\Admin\WhyChooseUs;

use App\Models\WcuSection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditComponent extends Component
{
    public $idEdit;
    public $icon; //'fas fa-icons';
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

    public function updateItem()
    {
        $item = WcuSection::find($this->idEdit);
        $item->icon = $this->icon;
        $item->title = $this->title;
        $item->description = $this->description;
        $item->status = $this->status;
        $item->order = $this->order;
        $item->update();
        $this->redirect(route('admin.why-choose-us'), navigate:true);
        toastr()->success('Item has been updated!' );
    }

    public function cancel()
    {
        return $this->redirect(route('admin.why-choose-us'), navigate:true);
    }

    public function mount($id)
    {
        $item = WcuSection::findOrFail($id);
        $this->idEdit = $id;  // передаем id в переменную для использования в форме редактирования
        $this->icon = $item->icon;
        $this->title = $item->title;
        $this->description = $item->description;
        $this->status = $item->status;
        $this->order = $item->order;
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        return view('livewire.admin.why-choose-us.edit-component');
    }
}
