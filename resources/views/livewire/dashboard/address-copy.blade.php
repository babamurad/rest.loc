<div class="tab-pane fade" id="v-pills-address" role="tabpanel"
     x-data="{ showAddress: 1, showNew: 0, showEdit: 0 }"
     wire:ignore.self
     aria-labelledby="v-pills-address-tab">
    <div class="fp_dashboard_body address_body">
        <h3>address <a class="add_new_address" @click="showAddress=0; showNew=1;"><i class="fas fa-plus"></i> add new
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
                                    @else
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="none" stroke="#f86f03" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008zm0 3h.008v.008h-.008zm0 3h.008v.008h-.008z"/></svg>
                                            office
                                        </span>
                                    @endif
                                    <span class="address"> {{ $address->address }}</span>
                                    <span class="address"> {{ $address->deliveryArea->area_name }}</span>
                                </label>
                            </div>
                            <ul>
                                <li><a class="dash_edit_btn" wire:click="edit({{ $address->id }})" @click="showEdit = 1; showAddress = 0;"><i class="fas fa-edit"></i></a></li>
                                <li><a class="dash_del_icon"><i class="fas fa-trash"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="dashboard_new_address" x-show="showNew">
                    <div class="row">
                        <div class="col-12">
                            <h4>add new address</h4>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-12">
                            <p>{{ $delivery_area_id }}</p>
                            <div class="fp__check_single_form mb-3">
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
                                <input type="text" placeholder="First Name" class="form-control @error('first_name') is-invalid @enderror" wire:model="first_name">
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
                            <p>{{ $type }}</p>
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
                            <button type="button" class="common_btn cancel_new_address" wire:click.prevent="cancel" @click="showNew=0; showAddress=1;">cancel</button>
                            <button type="button" class="common_btn" wire:click="save">save address</button>
                        </div>
                    </div>
            </div>
            <div class="dashboard_edit_address" x-show="showEdit">
                <div class="row">
                    <div class="col-12">
                        <h4>edit address</h4>
                    </div>
                    <div class="col-md-6 col-lg-12 col-xl-12">
                        <div class="fp__check_single_form">
                            <select id="select_js33" wire:model.live="delivery_area_id">
                                <option value="">{{__('select area')}}</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12 col-xl-6">
                        <div class="fp__check_single_form">
                            <input type="text" placeholder="First Name" class="form-control @error('first_name') is-invalid @enderror" wire:model="first_name">
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
                        <p>{{ $type }}</p>
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
                        {{--                             wire:click.prevent="cancel"--}}
                        <button type="button" class="common_btn cancel_new_address" wire:click.prevent="cancel" @click="showEdit=0; showAddress=1;">cancel</button>
                        <button type="button" class="common_btn" wire:click="update" @click="showEdit=0; showAddress=1;">save address</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
