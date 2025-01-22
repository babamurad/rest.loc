<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use App\Models\WhyChooseUs;

class TestimonialIndex extends Component
{
    use WithPagination;
    public $open = false;
    protected $paginationTheme = 'bootstrap';
    public $delId;

    public $title;
    public $top_title;
    public $sub_title;

    #[Layout('livewire.admin.layouts.admin-app')]
    public function render()
    {
        $testimonials = Testimonial::paginate(10);
        return view('livewire.admin.testimonial.testimonial-index', compact('testimonials'));
    }

    public function mount()
    {
        $titles = WhyChooseUs::where('key', 4)->first();
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

        try {
            $existingRecord = WhyChooseUs::where('key', 4)->first();
            if ($existingRecord) {
                $existingRecord->update(
                    [
                        'title' => $this->title,
                        'top_title' => $this->top_title,
                        'sub_title' => $this->sub_title,
                    ]
                );
            } else {
                $wsu = new WhyChooseUs();
                $wsu->key = '4';
                $wsu->title = $this->title;
                $wsu->top_title = $this->top_title;
                $wsu->sub_title = $this->sub_title;
                $wsu->save();
            }

            toastr()->success('Заголовки сохранены');
            $this->open = false;
        } catch (\Exception $e) {
            // Логирование ошибки для отладки
            \Log::error('Ошибка при сохранении данных: ' . $e->getMessage());
            toastr()->error('Произошла ошибка при сохранении данных');
            $this->open = true;
        }
    }

    public function getDelId($id)
    {
        $this->delId = $id;
    }

    public function destroy()
    {
        $testimonial = Testimonial::findOrFail($this->delId);
        $testimonial->delete();
        $this->dispatch('closeModal');
        session()->flash('message', 'Testimonial deleted successfully.');
    }

    public function ActInact($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = !$testimonial->status;
        $testimonial->save();
    }

    public function showAtHome($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->show_at_home = !$testimonial->show_at_home;
        $testimonial->save();
    }
}
