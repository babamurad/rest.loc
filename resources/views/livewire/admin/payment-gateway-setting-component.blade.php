<section class="section">
    <div class="section-header">
        <h1>{{__('Payment Gateway')}}</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{__('All gateways')}} {{ $activeTab }}</h4>
{{--                    +16468796749--}}
                </div>
                <div class="card-body" x-data="{ currentTab: $wire.entangle('activeTab') }">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2">
                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                <li class="nav-item my-1" @click="currentTab = 'altyn_asyr'" wire:click="changeTab('altyn_asyr')">
                                    <a class="nav-link" :class="{ 'active text-white': currentTab === 'altyn_asyr' }" style="cursor: pointer;">Altyn Asyr</a>
                                </li>
                                <li class="nav-item my-1" @click="currentTab = 'paypal'" wire:click="changeTab('paypal')">
                                    <a class="nav-link" :class="{ 'active text-white': currentTab === 'paypal' }" style="cursor: pointer;">Paypal</a>
                                </li>
                                <li class="nav-item my-1" @click="currentTab = 'stripe'" wire:click="changeTab('stripe')">
                                    <a class="nav-link" :class="{ 'active text-white': currentTab === 'stripe' }" style="cursor: pointer;">Stripe</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-10">
                            <div class="tab-content no-padding" id="myTab2Content">

                                <div class="tab-pane fade" x-show="currentTab === 'altyn_asyr'"  :class="{ ' show active': currentTab === 'altyn_asyr' }">
                                    Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                                    <button class="btn btn-primary" wire:click="paypalSettingUpdate" >Check</button>
                                </div>
                                <div class="tab-pane fade" x-show="currentTab === 'paypal'"  :class="{ ' show active': currentTab === 'paypal' }">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="paypal_status">Paypal {{__('Status')}}</label>
                                                        <select name="paypal_status" class="form-control @error('status') is-invalid @enderror" wire:model="status">
                                                            <option value="1">{{__('Active')}}</option>
                                                            <option value="0">{{__('Inactive')}}</option>
                                                        </select>
                                                        @error('status') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="paypal_account_mode">{{__('Paypal Account Mode')}}</label>
                                                        <select name="paypal_account_mode" class="form-control @error('paypal_account_mode') is-invalid @enderror" wire:model="paypal_account_mode">
                                                            <option value="sandbox">{{__('Sandbox')}}</option>
                                                            <option value="live">{{__('Live')}}</option>
                                                        </select>
                                                        @error('paypal_account_mode') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="paypal_country">{{__('Paypal Country Name')}}</label>
                                                        <select name="paypal_country" class="form-control @error('paypal_country') is-invalid @enderror" wire:model="paypal_country">
                                                            <option value="">{{__('Select')}}</option>
                                                            @foreach(config('countries') as $key => $country)
                                                                <option value="{{$key}}">{{ $country }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('paypal_country') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="paypal_currency">{{__('Paypal Currency')}}</label>
                                                        <select name="paypal_currency" class="form-control @error('paypal_currency') is-invalid @enderror" wire:model="paypal_currency">
                                                            <option value="sandbox">{{__('Select')}}</option>
                                                            @foreach(config('currencys.currency_list') as $key => $currency)
                                                                <option value="{{$currency}}">{{ $key }} {{$currency}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('paypal_currency') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="client_id">{{__('Paypal client ID')}}</label>
                                                        <input name="client_id" type="text" class="form-control @error('client_id') is-invalid @enderror" wire:model="client_id">
                                                        @error('client_id') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                    </div></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="secret_key">{{__('Paypal Secret Key')}}</label>
                                                        <input name="secret_key" type="text" class="form-control @error('secret_key') is-invalid @enderror" wire:model="secret_key">
                                                        @error('secret_key') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="image-preview @error('new_logo') border-danger @enderror"  style="
                                                 @if(strlen($paypal_logo) > 0)
                                                     background-image: url({{ asset($paypal_logo) }});
                                                 @elseif($new_logo)
                                                     background-image: url({{ $new_logo->temporaryUrl() }});
                                                @else
                                                     background-image: url({{ asset('uploads/sliders/placeholder.jpg') }});
                                                 @endif
                                                     background-size: cover;
                                                 @error('paypal_logo') border: 2px dashed #dc3545; @enderror
                                                    background-position: center center; width: 100%;">
                                                    <label for="paypal_logo" id="image-label">Choose File</label>
                                                    <input type="file" name="new_logo" id="paypal_logo" wire:model="new_logo">
                                                </div>
                                                @error('new_logo') <div class="invalid-feedback" style="display: block;">{{$message}}</div> @enderror
                                                <!-- Загрузка в процессе -->
                                                <div wire:loading wire:target="paypal_logo">
                                                    <p>Идет загрузка...</p> <!-- Сообщение, пока идет загрузка -->
                                                </div>
                                            </div>


                                            <button class="btn btn-primary" wire:click="paypalSettingUpdate">{{__('Save')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" x-show="currentTab === 'stripe'"  :class="{ ' show active': currentTab === 'stripe' }">
                                    Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('tab-css')
    <!-- Скрипты для модального окна -->
    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            text-align: center;
        }
    </style>
@endpush

</section>
