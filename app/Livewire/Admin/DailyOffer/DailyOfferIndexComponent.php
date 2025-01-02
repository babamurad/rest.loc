<?php

namespace App\Livewire\Admin\DailyOffer;

use App\Models\DailyOffer;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function deleteId($id)
    {
        $this->delId = $id;
    }

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $dailyOffers = DailyOffer::with('product')->get();
        return view('livewire.admin.daily-offer.daily-offer-index-component', compact('dailyOffers'));
    }
}
