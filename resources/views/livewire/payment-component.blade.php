<div>
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>payment</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><a href="javascript:;">payment</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section class="fp__payment_page mt_100 xs_mt_70 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                @include('components.layouts.preloader')
                <h2 class="h2">{{ __('Choose Your Payment Gateaway') }}</h2>
                <div class="col-lg-8">
                    <div class="fp__payment_area">
                        <div class="row">
                            {{--<div class="col-lg-3 col-6 col-sm-4 col-md-3 wow fadeInUp" data-wow-duration="1s">
                                <a class="fp__single_payment" href="#">
                                    <img src="{{ asset('images/paypal.webp') }}" alt="payment method" class="img-fluid w-100">
                                </a>
                            </div>
                            <div class="col-lg-3 col-6 col-sm-4 col-md-3 wow fadeInUp" data-wow-duration="1s">
                                <a class="fp__single_payment" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                   href="#">
                                    <img src="{{ asset('images/mastercard.jpg') }}" alt="payment method" class="img-fluid w-100">
                                </a>
                            </div>--}}

                            <div class="col-lg-3 col-6 col-sm-4 col-md-3 wow fadeInUp mt-5">
                                <div class="form-check" style="cursor: pointer;">
                                    <input class="form-check-input" type="checkbox" checked id="flexCheckDefault" style="cursor: pointer;">
                                    <label class="form-check-label" for="flexCheckDefault" style="margin-left: 0.4rem;  cursor: pointer;  margin-top: 0.2rem;">
                                        <span class="icon"> <i class="fas fa-money-bill-alt"></i> {{__('Pay on delivery')}}</span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt_25 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>{{ $total }}</span></p>
                        <p>delivery: <span>{{ $deliveryPrice }} </span>
                        </p>
                        <p>discount: <span>{{ $discount }}</span></p>
                        <p class="total"><span>total:</span> <span>{{ $total + $deliveryPrice - $discount }}</span></p>

                        <a class=" common_btn" href="javascript:;" wire:click.prevent="invoice">checkout</a>
                        <button class=" common_btn" wire:click="notification">notification</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="fp__payment_modal">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="fp__pay_modal_info">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora cum optio
                                cumque rerum dolor impedit exercitationem? Eveniet suscipit repellat, quae natus hic
                                assumenda.</p>
                            <ul>
                                <li>Natus hic assumenda consequatur excepturi ducimu.</li>
                                <li>Cumque rerum dolor impedit exercitationem Eveniet.</li>
                                <li>Dolor sit amet consectetur adipisicing elit tempora cum </li>
                            </ul>
                            <form>
                                <input type="text" placeholder="Enteer Something">
                                <textarea rows="4" placeholder="Enter Something"></textarea>
                                <select id="select_js3">
                                    <option value="">select country</option>
                                    <option value="">bangladesh</option>
                                    <option value="">nepal</option>
                                    <option value="">japan</option>
                                    <option value="">korea</option>
                                    <option value="">thailand</option>
                                </select>
                                <div class="fp__payment_btn_area">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============================
        PAYMENT PAGE END
    ==============================-->
</div>
