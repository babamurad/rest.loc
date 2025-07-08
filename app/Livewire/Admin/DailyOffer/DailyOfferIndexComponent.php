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

    /**
     * Изменяет статус ежедневного предложения (активный/неактивный).
     *
     * @param int $id
     * @return void
     */
    public function ActInact($id)
    {
        try {
            $dailyOffer = DailyOffer::find($id);
            $dailyOffer->status = !$dailyOffer->status;
            $dailyOffer->save();
            toastr()->success('Статус изменен!');
        } catch (\Exception $e) {
            \Log::error('Ошибка при изменении статуса ежедневного предложения: ' . $e->getMessage());
            toastr()->error('Ошибка при изменении статуса!');
        }
    }

    /**
     * Получает ID для удаления.
     *
     * @param int $id
     * @return void
     */
    public function getDelId($id)
    {
        $this->delId = $id;
    }

    /**
     * Удаляет ежедневное предложение.
     *
     * @return void
     */
    public function destroy()
    {
        try {
            DailyOffer::findOrFail($this->delId)->delete();
            $this->dispatch('closeModal');
            toastr()->success('Предложение удалено!');
        } catch (\Exception $e) {
            \Log::error('Ошибка при удалении ежедневного предложения: ' . $e->getMessage());
            toastr()->error('Ошибка при удалении!');
        }
    }

    /**
     * Сохраняет заголовки для ежедневных предложений.
     *
     * @return void
     */
    public function saveDailyTitle()
    {
        $this->validate(
            [
                'title' => 'required|max:255',
                'top_title' => 'required|max:255',
                'sub_title' => 'required|max:255',
            ]
        );

        try {
            WhyChooseUs::where('key', 2)->update([
                'title' => $this->title,
                'top_title' => $this->top_title,
                'sub_title' => $this->sub_title,
            ]);
            toastr()->success('Заголовки сохранены');
        } catch (\Exception $e) {
            \Log::error('Ошибка при сохранении заголовков: ' . $e->getMessage());
            toastr()->error('Ошибка при сохранении заголовков!');
        }
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
