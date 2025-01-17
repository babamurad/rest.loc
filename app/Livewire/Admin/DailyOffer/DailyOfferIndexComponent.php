<?php

namespace App\Livewire\Admin\DailyOffer;

use App\Models\DailyOffer;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\WhyChooseUs;

#[Title('Daily Offer')]
class DailyOfferIndexComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';
    public $sortIcon = '<i class="fas fa-sort mr-1 text-muted"></i>';
    public $perPage = 8;
    public $delId;
    public $title;
    public $top_title;
    public $sub_title;

    public function deleteId($id)
    {
        $this->delId = $id;
    }

    public function ActInact($id)
    {
        $dailyOffer = DailyOffer::find($id);
        $dailyOffer->status =!$dailyOffer->status;
        $dailyOffer->save();
    }

    public function getDelId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        DailyOffer::findOrFail($this->delId)->delete();
        $this->dispatch('closeModal');
        toastr()->flash('error', 'Item has been deleted.');
    }

    public function saveDailyTitle()
    {
        $this->validate(
            [
                'title' => 'required|max:255',
                'top_title' => 'required|max:255',
                'sub_title' => 'required|max:255',
            ]
        );

        WhyChooseUs::where('key', 2)->update([
            'title' => $this->title,
            'top_title' => $this->top_title,
            'sub_title' => $this->sub_title,
        ]);
//        dd('validate');
        toastr()->success('Заголовки сохранены');
    }

    public function mount()
    {
        $titles = WhyChooseUs::where('key', 2)->first();
        if ($titles) {
            $this->title = $titles->title;
            $this->top_title = $titles->top_title;
            $this->sub_title = $titles->sub_title;
        }
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $dailyOffers = DailyOffer::with('product')->paginate($this->perPage);
        return view('livewire.admin.daily-offer.daily-offer-index-component', compact('dailyOffers'));
    }
}
