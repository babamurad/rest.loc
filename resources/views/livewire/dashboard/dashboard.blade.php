@push('message')
    <style>
        .main_menu .menu_icon li .message_icon {
    font-size: 17px;
    position: relative;
    bottom: -3px;
}

.main_menu .menu_icon li .message_icon span {
    top: -14px;
}

.fp__dashboard_menu button b {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 20px;
    height: 20px;
    line-height: 20px;
    border-radius: 50%;
    background: var(--colorPrimary);
    text-align: center;
    font-size: 12px;
    font-weight: 500;
    color: var(--colorWhite);
}

.fp__chat_area {
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
}

.fp__chat_body {
    padding: 30px;
    padding-bottom: 0;
    height: 510px;
    overflow: hidden;
    overflow-y: auto;
}

.fp__chat_body::-webkit-scrollbar {
    background: #fff;
    width: 5px;
}

.fp__chat_body::-webkit-scrollbar-thumb {
    background: #ddd;
}

.fp__chating {
    display: flex;
    flex-wrap: wrap;
    justify-content: start;
    margin-bottom: 30px;
}

.fp__chating_img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
}

.fp__chating_text {
    margin-left: 20px;
    max-width: 84%;
}

.fp__chating_text p {
    background: #F5F9FF;
    color: var(--colorBlack);
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 5px;
    border: 1px solid #eeeeee73;
}

.fp__chating_text span {
    display: block;
}

.tf_chat_right {
    justify-content: end;
    flex-direction: row-reverse;
}

.tf_chat_right .fp__chating_text {
    margin-left: 0;
    margin-right: 20px;
}

.tf_chat_right .fp__chating_text span {
    text-align: right;
}

.fp__single_chat_bottom {
    border-top: 1px solid #5e5b5b17;
    position: relative;
    background: var(--colorWhite);
}

.fp__single_chat_bottom label {
    position: absolute;
    top: 50%;
    left: 30px;
    transform: translateY(-50%);
    font-size: 13px;
    cursor: pointer;
    width: 30px;
    height: 30px;
    background: #eee;
    color: var(--colorPrimary);
    line-height: 31px;
    text-align: center;
    border-radius: 50%;
    transition: all linear .3s;
    -webkit-transition: all linear .3s;
    -moz-transition: all linear .3s;
    -ms-transition: all linear .3s;
    -o-transition: all linear .3s;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
}

.fp__single_chat_bottom label:hover {
    background: var(--colorPrimary);
    color: var(--colorWhite);
}

.fp__single_chat_bottom input {
    width: 100%;
    border: none;
    padding: 20px 80px 20px 75px;
}

.fp__massage_btn {
    position: absolute;
    top: 50%;
    right: 30px;
    font-size: 18px;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: var(--colorPrimary);
    transform: translateY(-50%);
    color: var(--colorWhite);
    border-radius: 50%;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    transition: all linear .3s;
    -webkit-transition: all linear .3s;
    -moz-transition: all linear .3s;
    -ms-transition: all linear .3s;
    -o-transition: all linear .3s;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
}

.fp__massage_btn:hover {
    background: var(--colorBlack);
}
    </style>
@endpush

<div>
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>user dashboard</h1>
                    <ul>
                        <li><a href="/" wire:navigate>home</a></li>
                        <li><a href="javascript:;">dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=========================
        DASHBOARD START
    ==========================-->
    <section class="fp__dashboard mt_120 xs_mt_90 mb_100 xs_mb_70" x-data="{ activeTab: @entangle('activeTab'), showDeleteConfirmed: false }">
        @include('components.layouts.preloader')
        <div class="container">
            <div class="fp__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_menu">
                            <div class="dasboard_header">
                                <div class="dasboard_header_img">
                                    @if ($newimage)
                                        <img class="img-fluid w-100" src="{{ $newimage->temporaryUrl() }}"
                                            alt="{{ auth()->user()->name }}">
                                    @elseif($image)
                                        <img class="img-fluid w-100" src="{{ asset($image) }}"
                                            alt="{{ auth()->user()->name }}">
                                    @elseif(auth()->user()->avatar)
                                        <img class="img-fluid w-100" src="{{ asset(auth()->user()->avatar) }}"
                                            alt="{{ auth()->user()->name }}">
                                    @else
                                        <img class="img-fluid w-100" src="{{ asset('assets/images/avatar-placeholder.jpg') }}"
                                            alt="Placeholder">
                                    @endif
                                    @error('newimage')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <label for="upload"><i class="fas fa-camera"></i></label>
                                    <input type="file" id="upload" hidden wire:model="newimage">
                                </div>
                                <h2>{{ auth()->user()->name }}</h2>
                            </div>
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link"
                                    :class="activeTab === 'home' ? 'nav-link active' : 'nav-link'"
                                    @click="activeTab = 'home'"><span><i class="fas fa-user"></i></span>
                                    Parsonal Info</button>

                                <button class="nav-link"
                                    :class="activeTab === 'v-pills-address' ? 'nav-link active' : 'nav-link'"
                                    @click="activeTab = 'v-pills-address'">
                                    <span><i class="fas fa-map-marked"></i></span>address</button>

                                <button class="nav-link"
                                    :class="activeTab === 'order-list' ? 'nav-link active' : 'nav-link'"
                                    @click="activeTab = 'order-list'">
                                    <span><i class="fas fa-shopping-bag"></i></span>Order</button>

                                <button class="nav-link" :class="activeTab === 'messages' ? 'nav-link active' : 'nav-link'"
                                    @click="activeTab = 'messages'; $wire.markMessagesAsRead()">
                                    <span><i class="far fa-comment-dots"></i></span>
                                    Messages <b>{{ $unreadMessages }}</b>
                                </button>

                                <button class="nav-link" :class="activeTab === 'wishlist' ? 'nav-link active' : 'nav-link'"
                                    @click="activeTab = 'wishlist'">
                                    <span><i class="fas fa-heart"></i></span> wishlist
                                </button>

                                <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-messages" type="button" role="tab"
                                    aria-controls="v-pills-messages" aria-selected="false"><span><i
                                            class="fas fa-star"></i></span> Reviews</button>

                                <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-settings" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false"><span><i
                                            class="fas fa-user-lock"></i></span> Change Password </button>

                                <button class="nav-link" type="button" wire:click="logout"><span> <i
                                            class="fas fa-sign-out-alt"></i>
                                    </span> Logout</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__dashboard_content">
                            <div class="tab-content" id="v-pills-tabContent">

                                <livewire:dashboard.profile />

                                <livewire:dashboard.address />

                                <livewire:dashboard.order-component />

                                <livewire:dashboard.message-component />

                               <livewire:dashboard.wishlist-component />

                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                    aria-labelledby="v-pills-messages-tab">
                                    <div class="fp_dashboard_body dashboard_review">
                                        <h3>review</h3>
                                        <div class="fp__review_area">
                                            <div class="fp__comment pt-0 mt_20">
                                                <div class="fp__single_comment m-0 border-0">
                                                    <img src="{{ asset('assets/images/menu1.png') }}" alt="review"
                                                        class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3><a href="#">mamun ahmed shuvo</a> <span>29 oct 2022
                                                            </span>
                                                        </h3>
                                                        <span class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fad fa-star-half-alt"></i>
                                                            <i class="fal fa-star"></i>
                                                            <b>(120)</b>
                                                        </span>
                                                        <p>Sure there isn't anything embarrassing hiidden in the
                                                            middles of text. All erators on the Internet
                                                            tend to repeat predefined chunks</p>
                                                        <span class="status active">active</span>
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="{{ asset('assets/images/menu2.png') }}" alt=" review"
                                                        class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3><a href="#">asaduzzaman khan</a> <span>29 oct 2022
                                                            </span>
                                                        </h3>
                                                        <span class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fad fa-star-half-alt"></i>
                                                            <i class="fal fa-star"></i>
                                                            <b>(120)</b>
                                                        </span>
                                                        <p>Sure there isn't anything embarrassing hiidden in the
                                                            middles of text. All erators on the Internet
                                                            tend to repeat predefined chunks</p>
                                                        <span class="status inactive">inactive</span>
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="{{ asset('assets/images/menu3.png') }}" alt="review"
                                                        class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3><a href="#">ariful islam rupom</a> <span>29 oct 2022
                                                            </span>
                                                        </h3>
                                                        <span class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fad fa-star-half-alt"></i>
                                                            <i class="fal fa-star"></i>
                                                            <b>(120)</b>
                                                        </span>
                                                        <p>Sure there isn't anything embarrassing hiidden in the
                                                            middles of text. All erators on the Internet
                                                            tend to repeat predefined chunks</p>
                                                        <span class="status active">active</span>
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="{{ asset('assets/images/menu4.png') }}" alt="review"
                                                        class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3><a href="#">ali ahmed jakir</a> <span>29 oct 2022
                                                            </span>
                                                        </h3>
                                                        <span class="rating">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fad fa-star-half-alt"></i>
                                                            <i class="fal fa-star"></i>
                                                            <b>(120)</b>
                                                        </span>
                                                        <p>Sure there isn't anything embarrassing hiidden in the
                                                            middles of text. All erators on the Internet
                                                            tend to repeat predefined chunks</p>
                                                        <span class="status inactive">inactive</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="load_more">load More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <livewire:dashboard.change-password />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CART POPUT START -->
    <div class="fp__cart_popup">
        <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fal fa-times"></i></button>
                        <div class="fp__cart_popup_img">
                            <img src="{{ asset('assets/images/menu1.png') }}" alt="menu"
                                class="img-fluid w-100">
                        </div>
                        <div class="fp__cart_popup_text">
                            <a href="#" class="title">Maxican Pizza Test Better</a>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <span>(201)</span>
                            </p>
                            <h4 class="price">$320.00 <del>$350.00</del> </h4>

                            <div class="details_size">
                                <h5>select size</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="large" checked>
                                    <label class="form-check-label" for="large">
                                        large <span>+ $350</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="medium">
                                    <label class="form-check-label" for="medium">
                                        medium <span>+ $250</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="small">
                                    <label class="form-check-label" for="small">
                                        small <span>+ $150</span>
                                    </label>
                                </div>
                            </div>

                            <div class="details_extra_item">
                                <h5>select option <span>(optional)</span></h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="coca-cola">
                                    <label class="form-check-label" for="coca-cola">
                                        coca-cola <span>+ $10</span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="7up">
                                    <label class="form-check-label" for="7up">
                                        7up <span>+ $15</span>
                                    </label>
                                </div>
                            </div>

                            <div class="details_quentity">
                                <h5>select quentity</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger"><i class="fal fa-minus"></i></button>
                                        <input type="text" placeholder="1">
                                        <button class="btn btn-success"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3>$320.00</h3>
                                </div>
                            </div>
                            <ul class="details_button_area d-flex flex-wrap">
                                <li><a class="common_btn" href="#">add to cart</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CART POPUT END -->
    <!--=========================
        DASHBOARD END
    ==========================-->
</div>

