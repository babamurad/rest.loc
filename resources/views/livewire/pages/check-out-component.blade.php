<div  wire:loading.class="loading">
    @include('components.layouts.preloader')
{{--    <div class="overlay-container" wire:loading.class="loading">
        <div class="overlay"  wire:loading.class="active">
            <span class="loader"></span>
        </div>
    </div--}}>
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>checkout</h1>
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>home</a></li>
                        <li><a href="javascript:;">checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB ENDs
    ==============================-->

    <!--============================
            CHECK OUT PAGE START
        ==============================-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
{{--         x-data="{deliveryPrice: $wire.entangle('deliveryPrice')}"--}}
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__checkout_form">
                        <div class="fp__check_form">
                            <h5>select address <a href="#" data-bs-toggle="modal" data-bs-target="#address_modal"><i class="fas fa-plus"></i> add address</a></h5>
                            <div class="fp__address_modal">
                                <div class="modal fade" id="address_modal" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="address_modalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="address_modalLabel">add new address</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="fp_dashboard_new_address d-block">
                                                    <div class="col-md-6 col-lg-12 col-xl-12">
                                                        <div class="fp__check_single_form mb-3 mx-2">
                                                            <select class="form-select @error('delivery_area_id') is-invalid @enderror" wire:model="delivery_area_id">
                                                                <option value="">{{__('select area')}}</option>
                                                                @foreach($areas as $area)
                                                                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('delivery_area_id') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="First Name" class="@error('first_name') is-invalid @enderror" wire:model="first_name">
                                                                @error('first_name') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="Last Name" class="@error('last_name') is-invalid @enderror" wire:model="last_name">
                                                                @error('last_name') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="email" placeholder="Email *" class="@error('email') is-invalid @enderror" wire:model="email">
                                                                @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="Phone" class="@error('phone') is-invalid @enderror" wire:model="phone">
                                                                @error('phone') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <div class="fp__check_single_form">
                                                            <textarea cols="3" rows="4" placeholder="Address" class="@error('address') is-invalid @enderror" wire:model="address"></textarea>
                                                            @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xl-12">
                                                        <div class="fp__check_single_form check_area justify-content-center" wire:model="type">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked="" value="home">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f86f03" d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z"></path><path fill="#f86f03" d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97"></path></svg>
                                                                    home
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="office">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="#f86f03" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008zm0 3h.008v.008h-.008zm0 3h.008v.008h-.008z"></path></svg>
                                                                    office
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="other">
                                                                <label class="form-check-label" for="flexRadioDefault3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.4em" viewBox="0 0 16 16"><path fill="#f86f03" d="M3.252 1c-.69 0-1.25.56-1.25 1.25L2 10.75c0 .69.56 1.25 1.25 1.25H5v-1.565a2.5 2.5 0 0 1 .799-1.832l.652-.605A.5.5 0 1 1 7 7.488l1.64-1.522a2 2 0 0 1 2.359-.267A1.25 1.25 0 0 0 9.75 4.5h-.497a.25.25 0 0 1-.25-.25l.002-1.999c0-.69-.56-1.251-1.25-1.251zM4.5 4a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M5 5.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M4.5 8a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M7 3.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M6.5 6a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1m4.18.7a1 1 0 0 0-1.36 0L6.48 9.337a1.5 1.5 0 0 0-.48 1.1V14a1 1 0 0 0 1 1h1.5a1 1 0 0 0 1-1v-1h1v1a1 1 0 0 0 1 1H13a1 1 0 0 0 1-1v-3.564a1.5 1.5 0 0 0-.48-1.1zm-3.52 3.37L10 7.432l2.84 2.638a.5.5 0 0 1 .16.366V14h-1.5v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1H7v-3.564a.5.5 0 0 1 .16-.366"></path></svg>
                                                                    other
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-center mb-3">
                                                <button type="button" class="common_btn cancel_new_address mx-4 w-25" wire:click.prevent="cancel">cancel</button>
                                                <button type="submit" class="common_btn mx-4 w-25" wire:click="save">save address</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if($addresses->count() > 0)
                                @foreach($addresses as $address)
                                <div class="col-md-6" wire:key="{{ $address->id }}">
                                    <div class="fp__checkout_single_address">
                                        <div class="form-check">
                                            @if($address->type == 'home')
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="home-{{ $address->id }}" value="{{ $address->deliveryArea?->delivery_fee }}" wire:model.live="deliveryPrice">
                                                <label class="form-check-label" for="home-{{ $address->id }}">
                                                    <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f86f03" d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z"/><path fill="#f86f03" d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97"/></svg>
                                                    Home
                                                    </span>
                                                </label>
                                            @elseif($address->type == 'office')
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="office-{{ $address->id }}" value="{{ $address->deliveryArea?->delivery_fee }}" wire:model.live="deliveryPrice">
                                                <label class="form-check-label" for="office-{{ $address->id }}">
                                                <span class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="#f86f03" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008zm0 3h.008v.008h-.008zm0 3h.008v.008h-.008z"/></svg>
                                                Office
                                                </span>
                                                </label>
                                            @else
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="other-{{ $address->id }}" value="{{ $address->deliveryArea?->delivery_fee }}" wire:model.live="deliveryPrice">
                                                <label class="form-check-label" for="other-{{ $address->id }}">
                                                   <span class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.4em" viewBox="0 0 16 16"><path fill="#f86f03" d="M3.252 1c-.69 0-1.25.56-1.25 1.25L2 10.75c0 .69.56 1.25 1.25 1.25H5v-1.565a2.5 2.5 0 0 1 .799-1.832l.652-.605A.5.5 0 1 1 7 7.488l1.64-1.522a2 2 0 0 1 2.359-.267A1.25 1.25 0 0 0 9.75 4.5h-.497a.25.25 0 0 1-.25-.25l.002-1.999c0-.69-.56-1.251-1.25-1.251zM4.5 4a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M5 5.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M4.5 8a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M7 3.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M6.5 6a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1m4.18.7a1 1 0 0 0-1.36 0L6.48 9.337a1.5 1.5 0 0 0-.48 1.1V14a1 1 0 0 0 1 1h1.5a1 1 0 0 0 1-1v-1h1v1a1 1 0 0 0 1 1H13a1 1 0 0 0 1-1v-3.564a1.5 1.5 0 0 0-.48-1.1zm-3.52 3.37L10 7.432l2.84 2.638a.5.5 0 0 1 .16.366V14h-1.5v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1H7v-3.564a.5.5 0 0 1 .16-.366"/></svg>
                                                    Other
                                                   </span>
                                                </label>
                                            @endif
                                            <label class="form-check-label">
                                                <span class="address"> {{ $address->address }}</span>
                                                <span class="address"> <b>{{ $address->deliveryArea?->area_name }}</b> </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div id="sticky_sidebar" class="fp__cart_list_footer_button">
                        <h6>{{__('total cart')}}</h6>
                        <p>{{__('subtotal')}}: <span>{{ number_format($cartTotalSum, 2) }} man.</span></p>
                        <p>{{__('delivery')}}: <span>{{ number_format($deliveryPrice, 2) }} man.</span></p>
                        @if(session()->has('coupon'))
                            @if(session()->get('coupon')['discount_type'] == 'percent')
                                <p><span>{{__('discount')}}: {{ session()->get('coupon')['discount'] }} %</span><span> {{ number_format(session()->get('coupon')['discount'] * $cartTotalSum / 100, 2) }} man.</span></p>
                                <?php $grandSum = number_format($cartTotalSum + $deliveryPrice - number_format(session()->get('coupon')['discount'] * $cartTotalSum / 100, 2), 2);  ?>
                            @else
                                <p><span>{{__('discount')}}:</span><span>{{ number_format(session()->get('coupon')['discount'], 2) }} man.</span></p>
                                <?php $grandSum = number_format($cartTotalSum + $deliveryPrice - session()->get('coupon')['discount'], 2);  ?>
                            @endif
                        @else
                            <p>{{__('discount')}}: <span>0 man.</span></p>
                        @endif

                        <p class="total"><span>{{__('total')}}:</span>
                            @if(session()->has('coupon'))
                                <del class="text-danger">{{ number_format($cartTotalSum + $deliveryPrice, 2) }} man.</del>
                                <span>{{ $grandSum }} man.</span>
                            @else
                                <span>{{ number_format($cartTotalSum + $deliveryPrice, 2) }} man.</span>
                            @endif
                        </p>

                        <a class="common_btn" href="#" wire:click.prevent="payout">{{ __('Proceed to payment') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CHECK OUT PAGE END
    ==============================-->
    <script>
        window.addEventListener('close-modal', event=> {
            $('#address_modal').modal('hide');
        })
    </script>
</div>
