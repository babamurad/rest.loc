<section class="section">
    <div class="section-header">
        <h1>Messages</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admin.chat') }}">Messages</a></div>
        </div>
    </div>

    <div class="section-body">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card" style="height: 100vh;">
                    <div class="card-header">
                        <h4>Who's Online?</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach($chatUsers as $chatUser)
                            @php
                                $userId = $chatUser->id;
                                $key = $userId;
                            @endphp
                            <li class="media">
                                <a href="javascript:;" wire:click.prevent="setUserId({{ $userId }})">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                    src="{{ asset($chatUser->avatar) }}">
                                    <div class="media-body">
                                        <div class="mt-0 mb-1 font-weight-bold">{{ $chatUser->name }}</div>
                                        <div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i>
                                            Online</div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
{{--  :--}}
            <livewire:admin.admin-chat-conversation :userId="$userId" :key="$key" />
        </div>
    </div>
</section>
