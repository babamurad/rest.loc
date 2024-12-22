class Dashboard extends Component
{
    public $unreadMessages;

    public function mount()
    {
        $this->updateMessageCount();
    }

    #[On('updateMessageCount')]
    public function updateMessageCount()
    {
        $this->unreadMessages = Message::where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->count();
    }

    public function markMessagesAsRead()
    {
        Message::where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
        
        $this->updateMessageCount();
    }
} 