<div class="tab-pane fade"  x-show="activeTab === 'messages'"
:class="activeTab === 'messages' ? 'tab-pane fade active show' : 'tab-pane fade'">
    <div class="fp_dashboard_body fp__change_password">
        <div class="fp__message">
            <h3>Messages</h3>
            @include('components.layouts.preloader')
            <div class="fp__chat_area">
                <div class="fp__chat_body">
                    @foreach($chats as $chat)
                    @if($chat->sender_id != Auth::user()->id)
                    <div class="fp__chating">
                        <div class="fp__chating_img">
                            <img src="{{ asset('assets/images/service_provider.png') }}" alt="person"
                                class="img-fluid w-100">
                        </div>
                        <div class="fp__chating_text">
                            <p>{{ $chat->message }}</p>
                            <span>{{ \Carbon\Carbon::create($chat->created_at)->format('F d, Y H:i') }}</span>
                        </div>
                    </div>
                    @else
                    <div class="fp__chating tf_chat_right">
                        <div class="fp__chating_img">
                            <img src="{{ asset(auth()->user()->avatar) }}" alt="person"
                                class="img-fluid rounded-circle w-100">
                        </div>
                        <div class="fp__chating_text">
                            <p>{{ $chat->message }}</p>
                            <span>{{ \Carbon\Carbon::create($chat->created_at)->format('F d, Y H:i') }}</span>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    
                </div>
                <form class="fp__single_chat_bottom" wire:submit.prevent="sendMessage">
                    @csrf
                    <label for="select_file"><i class="fas fa-file-medical" aria-hidden="true"></i></label>
                    <input id="select_file" type="file" hidden="">
                    <input type="text" placeholder="Type a message..." wire:model="message">
                    <button type="submit" class="fp__massage_btn"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
