<div class="tab-pane fade" id="v-pills-address" role="tabpanel"
     aria-labelledby="v-pills-address-tab">
    <div class="fp_dashboard_body address_body">
        <h3>address <a class="dash_add_new_address"><i class="far fa-plus"></i> add new
            </a>
        </h3>
        <div class="fp_dashboard_address">
            <div class="fp_dashboard_existing_address">
                <div class="row">
                    <div class="col-md-6">
                        <div class="fp__checkout_single_address">
                            <div class="form-check">
                                <label class="form-check-label">
                                <span class="icon"><i class="fas fa-home"></i> home</span>
                                    <span class="address">house# 22, road# 10, block# G, Basundhara Residential Area.</span>
                                </label>
                            </div>
                            <ul>
                                <li><a class="dash_edit_btn"><i class="far fa-edit"></i></a></li>
                                <li><a class="dash_del_icon"><i class="fas fa-trash-alt"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="fp__checkout_single_address">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <span class="icon"><i class="far fa-car-building"></i>office</span>
                                    <span class="address">house# 22, road# 10, block# G, Basundhara Residential Area.</span>
                                </label>
                            </div>
                            <ul>
                                <li><a class="dash_edit_btn"><i class="far fa-edit"></i></a></li>
                                <li><a class="dash_del_icon"><i class="fas fa-trash-alt"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fp_dashboard_new_address ">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <h4>add new address</h4>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <select id="select_js3" >
                                    <option value="">{{__('select area')}}</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="First Name" wire:model="first_name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="email" placeholder="Email *">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <textarea cols="3" rows="4" placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="fp__check_single_form check_area">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f86f03" d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z"/><path fill="#f86f03" d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97"/></svg>
                                        home
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="#f86f03" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008zm0 3h.008v.008h-.008zm0 3h.008v.008h-.008z"/></svg>
                                        office
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="common_btn cancel_new_address" wire:click="cancel">cancel</button>
                            <button type="submit" class="common_btn" wire:click="save">save address</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="fp_dashboard_edit_address ">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <h4>edit address </h4>
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
                                                                <textarea cols="3" rows="4"
                                                                          placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="fp__check_single_form check_area">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                           name="flexRadioDefault2"
                                           id="flexRadioDefault12">
                                    <label class="form-check-label"
                                           for="flexRadioDefault12">
                                        home
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                           name="flexRadioDefault2"
                                           id="flexRadioDefault22">
                                    <label class="form-check-label"
                                           for="flexRadioDefault22">
                                        office
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button"
                                    class="common_btn cancel_edit_address">cancel
                            </button>

                            <button type="submit" class="common_btn">update
                                address
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
