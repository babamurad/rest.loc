<?php

namespace App\Livewire\Admin\WhyChooseUs;

use App\Models\WcuSection;
use App\Models\WhyChooseUs;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WhyChooseUsComponent extends Component
{

    public $title;
    public $top_title;
    public $sub_title;

    public $delId;

    public function destroy()
    {
        $item = WcuSection::findOrFail($this->delId);
        $item->delete();
        $this->dispatch('closeModal');
        toastr()->error('Deleted!');
    }

    public function deleteId($id)
    {
        $this->delId = $id;
    }

    public function saveTitle()
    {
        $this->validate(
            [
                'title' => 'required|max:255',
                'top_title' => 'required|max:255',
                'sub_title' => 'required|max:255',
            ]
        );
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
        if ($titles) {
            $this->title = $titles->title;
            $this->top_title = $titles->top_title;
            $this->sub_title = $titles->sub_title;
        }
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $chooses = WcuSection::orderBy('order', 'asc')->get();
        return view('livewire.admin.why-choose-us.why-choose-us-component', compact('chooses'));
    }
}
