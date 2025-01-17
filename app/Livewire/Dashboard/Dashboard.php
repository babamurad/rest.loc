<?php

namespace App\Livewire\Dashboard;

use App\Models\Chat;
use App\Models\DeliveryArea;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;


#[Title('User Dashboard')]
class Dashboard extends Component
{
    use WithFileUploads;
    public $image;
    public $newimage;
    public $activeTab;  
    public $unreadMessages;  

    public function mount($activeTab = 'home')
    {
        $this->activeTab = $activeTab;
        $this->image = Auth::user()->avatar;
        $this->updateMessageCount();
    }
    
    public function updateMessageCount()
    {
        $this->unreadMessages = Chat::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();
        $this->dispatch('new-message');    
    }

    public function markMessagesAsRead()
    {
        Chat::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        $this->updateMessageCount();
        $this->dispatch('new-message');
    }

    public function updatedNewimage()
    {

        $user = User::FindOrFail(Auth::user()->id);

        if ($this->newimage){
            if (file_exists('images/' . $user->avatar)) {
                try {
                    unlink('images/' . $user->avatar);
                } catch (\Exception $e){
                    flash()->error('Something went wrong! Failed to delete.' . $e);
                };
            }
            $imageName = Carbon::now()->timestamp.'.'.$this->newimage->extension();

            $this->newimage->storeAs($imageName);
            $user->avatar = $imageName;

            $user->update();
            flash()->success('User avatar image has been updated successfully!');
            $this->dispatch('change-profile-image');
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        // return redirect()->route('/');
        return $this->redirect('/login', navigate:true);
    }

    public function cancel()
    {
        $this->reset();
    }

    public function updateUnreadCount()
    {
        $unreadCount = Chat::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        $this->dispatch('unreadCountUpdated', ['count' => $unreadCount]);
    }

    public function render()
    {
        $areas = DeliveryArea::where('status', 1)->orderBy('area_name', 'asc')->get();
        //$adresses = \App\Models\Address::where('user_id', auth()->user()->id)->with('deliveryArea')->get();
        return view('livewire.dashboard.dashboard', compact('areas'));
    }
}
