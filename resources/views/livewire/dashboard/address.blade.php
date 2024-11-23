<div class="tab-pane fade" x-show="activeTab === 'v-pills-address'"
     :class="activeTab === 'v-pills-address' ? 'tab-pane fade active show' : 'tab-pane fade'"
     x-data="{ showForm: $wire.entangle('showForm')}"
><h3 x-text="showForm"></h3>
{{--    show_new_address--}}
{{--    show_edit_address--}}
    <div class="fp_dashboard_body address_body"
         :class="showForm == 'Address' ? 'fp_dashboard_body address_body' : (showForm == 'newAddress' ? 'fp_dashboard_body address_body show_new_address' : 'fp_dashboard_body address_body show_edit_address')"
    >
        <h3>address <a class="dash_add_new_address" @click="showForm='newAddress'"><i class="far fa-plus"></i> add new
            </a>
        </h3>

        <div class="fp_dashboard_address">
            <div class="fp_dashboard_existing_address">
                <div class="row">
                    @foreach($adresses as $address )
                        <div class="col-md-6">
                            <div class="fp__checkout_single_address">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        @if($address->type == 'home')
                                            <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f86f03" d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z"/><path fill="#f86f03" d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97"/></svg>
                                            home
                                        </span>
                                        @elseif($address->type == 'office')
                                            <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="#f86f03" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008zm0 3h.008v.008h-.008zm0 3h.008v.008h-.008z"/></svg>
                                            office
                                        </span>
                                        @else
                                            <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.4em" viewBox="0 0 16 16"><path fill="#f86f03" d="M3.252 1c-.69 0-1.25.56-1.25 1.25L2 10.75c0 .69.56 1.25 1.25 1.25H5v-1.565a2.5 2.5 0 0 1 .799-1.832l.652-.605A.5.5 0 1 1 7 7.488l1.64-1.522a2 2 0 0 1 2.359-.267A1.25 1.25 0 0 0 9.75 4.5h-.497a.25.25 0 0 1-.25-.25l.002-1.999c0-.69-.56-1.251-1.25-1.251zM4.5 4a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M5 5.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M4.5 8a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M7 3.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M6.5 6a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1m4.18.7a1 1 0 0 0-1.36 0L6.48 9.337a1.5 1.5 0 0 0-.48 1.1V14a1 1 0 0 0 1 1h1.5a1 1 0 0 0 1-1v-1h1v1a1 1 0 0 0 1 1H13a1 1 0 0 0 1-1v-3.564a1.5 1.5 0 0 0-.48-1.1zm-3.52 3.37L10 7.432l2.84 2.638a.5.5 0 0 1 .16.366V14h-1.5v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1H7v-3.564a.5.5 0 0 1 .16-.366"/></svg>
                                            other
                                            </span>
                                        @endif
                                        <span class="address"> {{ $address->address }}</span>
                                        <span class="address"> {{ $address->deliveryArea->area_name }}</span>
                                    </label>
                                </div>
                                <ul>
                                    <li><a class="dash_edit_btn" wire:click="edit({{ $address->id }})" @click="showForm='editAddress'"><i class="fas fa-edit"></i></a></li>
                                    <li><a class="dash_del_icon"><i class="fas fa-trash"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="fp_dashboard_new_address ">
                <form wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-12">
                            <h4>add new address</h4>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form mb-3 mx-2">
                                <select class="form-select" id="select_js33" wire:model="delivery_area_id">
                                    <option value="">{{__('select area')}}</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="email" placeholder="Email *" wire:model="email">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Phone" wire:model="phone">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <textarea cols="3" rows="4" placeholder="Address" wire:model="address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="fp__check_single_form check_area" wire:model="type">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" @if($type == 'home') checked @endif value="home">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f86f03" d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z"/><path fill="#f86f03" d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97"/></svg>
                                        home
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" @if($type == 'office') checked @endif value="office">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="#f86f03" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008zm0 3h.008v.008h-.008zm0 3h.008v.008h-.008z"/></svg>
                                        office
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" @if($type == 'other') checked @endif value="other">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.4em" viewBox="0 0 16 16"><path fill="#f86f03" d="M3.252 1c-.69 0-1.25.56-1.25 1.25L2 10.75c0 .69.56 1.25 1.25 1.25H5v-1.565a2.5 2.5 0 0 1 .799-1.832l.652-.605A.5.5 0 1 1 7 7.488l1.64-1.522a2 2 0 0 1 2.359-.267A1.25 1.25 0 0 0 9.75 4.5h-.497a.25.25 0 0 1-.25-.25l.002-1.999c0-.69-.56-1.251-1.25-1.251zM4.5 4a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M5 5.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M4.5 8a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1M7 3.5a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0M6.5 6a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1m4.18.7a1 1 0 0 0-1.36 0L6.48 9.337a1.5 1.5 0 0 0-.48 1.1V14a1 1 0 0 0 1 1h1.5a1 1 0 0 0 1-1v-1h1v1a1 1 0 0 0 1 1H13a1 1 0 0 0 1-1v-3.564a1.5 1.5 0 0 0-.48-1.1zm-3.52 3.37L10 7.432l2.84 2.638a.5.5 0 0 1 .16.366V14h-1.5v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1H7v-3.564a.5.5 0 0 1 .16-.366"/></svg>
                                        other
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="common_btn cancel_new_address" wire:click.prevent="cancel" @click="showForm='Address'">cancel</button>
                            <button type="submit" class="common_btn">save address</button>
{{--                             @click="showForm='Address'"--}}
                        </div>
                    </div>
                </form>
            </div>
            <div class="fp_dashboard_edit_address ">
                <form wire:submit.prevent="update">
                    <div class="row">
                        <div class="col-12">
                            <h4>edit address</h4>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form mb-3 mx-2">
                                <select class="form-select" id="select_js33" wire:model="delivery_area_id">
                                    <option value="">{{__('select area')}}</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="email" placeholder="Email *" wire:model="email">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <div class="fp__check_single_form">
                                <input type="text" placeholder="Phone" wire:model="phone">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="fp__check_single_form">
                                <textarea cols="3" rows="4" placeholder="Address" wire:model="address"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="fp__check_single_form check_area" wire:model="type">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" @if($type == 'home') checked @endif value="home">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="#f86f03" d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z"/><path fill="#f86f03" d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97"/></svg>
                                        home
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" @if($type == 'office') checked @endif value="office">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="#f86f03" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008zm0 3h.008v.008h-.008zm0 3h.008v.008h-.008z"/></svg>
                                        office
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="common_btn cancel_new_address" wire:click.prevent="cancel" @click="showForm='Address'">cancel</button>
                            <button type="submit" class="common_btn" @click="showForm='Address'">save address</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
