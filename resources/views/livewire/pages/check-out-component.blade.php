<div>
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>checkout</h1>
                    <ul>
                        <li><a href="index.html">home</a></li>
                        <li><a href="javascript:;">checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->

    <!--============================
            CHECK OUT PAGE START
        ==============================-->
    <section class="fp__cart_view mt_125 xs_mt_95 mb_100 xs_mb_70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__checkout_form">
                        <div class="fp__check_form">
                            <h5>select address <a href="#" data-bs-toggle="modal" data-bs-target="#address_modal"><i
                                        class="far fa-plus"></i> add address</a></h5>

                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="#f86f03" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008zm0 3h.008v.008h-.008zm0 3h.008v.008h-.008z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f86f03" d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z"/><path fill="#f86f03" d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.4em" viewBox="0 0 16 16"><path fill="#f86f03" d="M3.252 1c-.69 0-1.25.56-1.25 1.25L2 10.75c0 .69.56 1.25 1.25 1.25H5v-1.565a2.5 2.5 0 0 1 .799-1.832l.652-.605A.5.5 0 1 1 7 7.488l1.64-1.522a2 2 0 0 1 2.359-.267A1.25 1.25 0 0 0 9.75 4.5h-.497a.25.25 0 0 1-.25-.25l.002-1.999c0-.69-.56-1.251-1.25-1.251zM4.5 4a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M5 5.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M4.5 8a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M7 3.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M6.5 6a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1m4.18.7a1 1 0 0 0-1.36 0L6.48 9.337a1.5 1.5 0 0 0-.48 1.1V14a1 1 0 0 0 1 1h1.5a1 1 0 0 0 1-1v-1h1v1a1 1 0 0 0 1 1H13a1 1 0 0 0 1-1v-3.564a1.5 1.5 0 0 0-.48-1.1zm-3.52 3.37L10 7.432l2.84 2.638a.5.5 0 0 1 .16.366V14h-1.5v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1H7v-3.564a.5.5 0 0 1 .16-.366"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="#f86f03" d="M15 9h2v2h-2zm2-4h-2v2h2zm-6 10h2v-2h-2zm2-10h-2v2h2zm-2 6h2V9h-2zM9 5H7v2h2zm0 4H7v2h2zm5.55 12H13v-3.5h-2V21H5V3h14v8.03c.71.06 1.39.28 2 .6V1H3v22h12.91c-.41-.56-.91-1.24-1.36-2M7 19h2v-2H7zm2-6H7v2h2zm13 3.5c0 2.6-3.5 6.5-3.5 6.5S15 19.1 15 16.5c0-1.9 1.6-3.5 3.5-3.5s3.5 1.6 3.5 3.5m-2.3.1c0-.6-.6-1.2-1.2-1.2s-1.2.5-1.2 1.2c0 .6.5 1.2 1.2 1.2s1.3-.6 1.2-1.2"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="#f86f03" d="M12 14c2.206 0 4-1.794 4-4s-1.794-4-4-4s-4 1.794-4 4s1.794 4 4 4m0-6c1.103 0 2 .897 2 2s-.897 2-2 2s-2-.897-2-2s.897-2 2-2"/><path fill="#f86f03" d="M11.42 21.814a1 1 0 0 0 1.16 0C12.884 21.599 20.029 16.44 20 10c0-4.411-3.589-8-8-8S4 5.589 4 9.995c-.029 6.445 7.116 11.604 7.42 11.819M12 4c3.309 0 6 2.691 6 6.005c.021 4.438-4.388 8.423-6 9.73c-1.611-1.308-6.021-5.294-6-9.735c0-3.309 2.691-6 6-6"/></svg>


                            <div class="fp__address_modal">
                                <div class="modal fade" id="address_modal" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="address_modalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="address_modalLabel">add new address
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="Last Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                                            <div class="fp__check_single_form">
                                                                <input type="text"
                                                                       placeholder="Company Name (Optional)">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <select id="select_js4">
                                                                    <option value="">select country</option>
                                                                    <option value="">bangladesh</option>
                                                                    <option value="">nepal</option>
                                                                    <option value="">japan</option>
                                                                    <option value="">korea</option>
                                                                    <option value="">thailand</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="Street Address *">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text"
                                                                       placeholder="Apartment, suite, unit, etc. (optional)">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="Town / City *">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="State *">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="Zip *">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="text" placeholder="Phone *">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                                            <div class="fp__check_single_form">
                                                                <input type="email" placeholder="Email *">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                                            <div class="fp__check_single_form">
                                                                <h5>Additional Information</h5>
                                                                <textarea cols="3" rows="4"
                                                                          placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="fp__check_single_form m-0">
                                                                <button type="submit" class="common_btn">add
                                                                    address</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach($addresses as $adress)
                                <div class="col-md-6">
                                    <div class="fp__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                   id="home">
                                            <label class="form-check-label" for="home">
                                                <span class="icon"><i class="fas fa-home"></i> home</span>
                                                <span class="address">{{ $adress->address }}</span>
                                            </label>
                                        </div>
                                        <label class="address" style="padding-left: 1.5em;"><span>Region: Bahar</span></label>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <h5>billing address</h5>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="Company Name (Optional)">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <select id="select_js3">
                                                <option value="">select country</option>
                                                <option value="">bangladesh</option>
                                                <option value="">nepal</option>
                                                <option value="">japan</option>
                                                <option value="">korea</option>
                                                <option value="">thailand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="Street Address *">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="Town / City *">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="State *">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="Zip *">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="text" placeholder="Phone *">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="fp__check_single_form">
                                            <input type="email" placeholder="Email *">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="fp__check_single_form">
                                            <h5>Additional Information</h5>
                                            <textarea cols="3" rows="4"
                                                      placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div id="sticky_sidebar" class="fp__cart_list_footer_button">
                        <h6>total cart</h6>
                        <p>subtotal: <span>{{ $this->cartTotal() }}</span></p>
                        <p>delivery: <span>{{ $delivery }}</span></p>
                        <p>discount: <span>{{ $discount }}</span></p>
                        <p class="total"><span>total:</span> <span>{{ number_format($this->cartTotal() + $delivery - $discount, 2) }}</span></p>
                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit">apply</button>
                        </form>
                        <a class="common_btn" href=" #">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CHECK OUT PAGE END
    ==============================-->

</div>
