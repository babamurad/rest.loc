<?php

namespace App\Livewire\Admin\Chef;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Chef;
use Livewire\Attributes\Layout;
use App\Models\WhyChooseUs;

class ChefIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $delId;

    public $title;
    public $top_title;
    public $sub_title;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $chefs = Chef::paginate(10);
        return view('livewire.admin.chef.chef-index', compact('chefs'));
    }

    public function mount()
    {
        $titles = WhyChooseUs::where('key', 3)->first();
        if ($titles) {
            $this->title = $titles->title;
            $this->top_title = $titles->top_title;
            $this->sub_title = $titles->sub_title;
        }
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
        WhyChooseUs::where('key', 3)->update([
           'title' => $this->title,
           'top_title' => $this->top_title,
           'sub_title' => $this->sub_title,
        ]);
        toastr()->success('Заголовки сохранены');
    }

    public function getDelId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        Chef::findOrFail($this->delId)->delete();
        $this->dispatch('closeModal');
        toastr()->error(__('Chef deleted successfully'));
    }

    public function ActInact($id)
    {
        $chef = Chef::findOrFail($id);
        $chef->status = !$chef->status;
        $chef->save();
    }

    public function showAtHome($id)
    {
        $chef = Chef::findOrFail($id);
        $chef->show_at_home = !$chef->show_at_home;
        $chef->save();
    }
}
