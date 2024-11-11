<div>
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>menu Details</h1>
                    <ul>
                        <li><a href="/">home</a></li>
                        <li><a href="javascript:;">menu Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->

    <script>
            window.addEventListener('carouselUpdated', event => {
                $("#exzoom").exzoom();

            });

    </script>

    <!-- CART POPUT START -->
    <div class="fp__cart_popup"
         x-data="{
             totalSummary: 0,
             selectedSize: { id: null, name: '', price: 0 },
             checkedOptions: [],
             checkedOptionsId: [],
             summa : 0,
             count : 1,
             sizeId: 0,
             getTotalOptionPrice() {
            // Calculate the total price of selected options
            let totalOptionPrice = 0;
            for (const option of this.checkedOptions) {
              totalOptionPrice += parseFloat(option); // Ensure number conversion
            }
            return totalOptionPrice;
            },
            resetOptions() {
            this.checkedOptions = [];
            },
            resetVariables() {
                 this.totalSummary = 0;
                 this.selectedSize = { id: null, name: '', price: 0 };
                 this.checkedOptions = [];
                 this.checkedOptionsId = [];
                 this.summa = 0;
                 this.count = 1;
             }
         }"
    >
        <div wire:ignore.self class="modal fade"
             id="cartModal" tabindex="-1" aria-hidden="true"
             wire:loading.class="d-none"
             wire:target="getProduct">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fal fa-times"></i></button>
                        <div class="fp__cart_popup_img">
                            <img src="{{ asset($reProduct->thumb_image) }}" alt="{{ $reProduct->name }}" class="img-fluid w-100">
                        </div>
                        <div class="fp__cart_popup_text">
                            <a href="{{ route('product-details', ['slug' => $reProduct->slug]) }}" class="title">{{ $reProduct->name }}</a>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <span>(201)</span>
                            </p>
                            @if($reProduct->offer_price)
                                <h4 class="price" x-bind="totalSummary={{ $reProduct->offer_price }}">${{ $reProduct->offer_price }} <del>${{ $reProduct->price }}</del> </h4>
                            @else
                                <h4 class="price" x-bind="totalSummary={{ $reProduct->price }}">${{ $reProduct->price }}</h4>
                            @endif

                            <div class="details_size">
                                <h5>select size</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                           id="standart_option" checked value="0"
                                           @change="selectedSize = { id: null, price: 0 }">
                                    <h6 class="form-check-label" for="standart_option">
                                        Standart <span>+ $0</span>
                                    </h6>
                                </div>
                                @if($reProduct->sizes->count() > 0)
                                    @foreach($reProduct->sizes as $size)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                   id="size-{{$size->id}}"
                                                   value="{{ $size->price }}"
                                                   @change="selectedSize={ id: {{$size->id}}, name: '{{$size->name}}', price: {{ (float) $size->price }} }"
                                            >
                                            <h6 class="form-check-label" for="size-{{$size->id}}">
                                                {{$size->id}} - {{ Str::words($size->name, 1, '') }} <span>+ ${{ $size->price }}</span>
                                            </h6>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="details_extra_item">
                                <h5>select option <span>(optional)</span></h5>
                                @if($reProduct->options->count() > 0)
                                    @foreach($reProduct->options as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   value="{{ $option->price }}"
                                                   id="option-{{ $option->id }}"
                                                   x-model="checkedOptions"
                                                   @change="checkedOptionsId.push({{$option->id}})"
                                            >
                                            <h6 class="form-check-label" for="option-{{ $option->id }}">
                                                {{ $option->name }} <span>+ ${{ $option->price }}</span>
                                            </h6>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="details_quentity">
                                <h5>select quentity</h5>
                                <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                    <div class="quentity_btn">
                                        <button class="btn btn-danger" @click="if (count > 1) count--"><i class="fal fa-minus"></i></button>
                                        <input type="text"  x-model="count">
                                        <button class="btn btn-success" @click="count++"><i class="fal fa-plus"></i></button>
                                    </div>
                                    <h3><span x-text="summa=((totalSummary + selectedSize.price) * count + getTotalOptionPrice()).toFixed(2)"></span></h3>
                                </div>
                            </div>
                            <ul class="details_button_area d-flex flex-wrap">
                                <li>
                                    <button class="common_btn"
                                            @if($closeModal)
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                            @endif
                                            wire:click="addToCart('{{ $reProduct->id }}', count, summa, selectedSize.id, selectedSize.name, selectedSize.price, checkedOptionsId)"
                                            wire:loading.attr="disabled"
                                    >
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" wire:loading></span>
                                        <span class="text-white" wire:loading.remove>add to cart</span>
                                        <span class="text-white" wire:loading>Loading...</span>
                                    </button>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CART POPUT END -->

    <!--=============================
        MENU DETAILS START
    ==============================-->
    <section class="fp__menu_details mt_115 xs_mt_85 mb_95 xs_mb_65"
             wire:ognore
             x-data="{
             totalSummary: 0,
             selectedSize: { id: null, name: '', price: 0 },
             checkedOptions: [],
             checkedOptionsId: [],
             summa : 0,
             count : 1,
             sizeId: 0,
             getTotalOptionPrice() {
            // Calculate the total price of selected options
            let totalOptionPrice = 0;
            for (const option of this.checkedOptions) {
              totalOptionPrice += parseFloat(option); // Ensure number conversion
            }
            return totalOptionPrice;
            },
            resetVariables() {
                 this.totalSummary = 0;
                 this.selectedSize = { id: null, name: '', price: 0 };
                 this.checkedOptions = [];
                 this.checkedOptionsId = [];
                 this.summa = 0;
                 this.count = 1;
             }
         }"
    >
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-9 wow fadeInUp" data-wow-duration="1s">
                    <div class="exzoom hidden" id="exzoom">
                        <div class="exzoom_img_box fp__menu_details_images">
                            <ul class='exzoom_img_ul'>
                                <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}"></li>
                                @foreach($imagePaths as $imagePath)
                                <li><img class="zoom ing-fluid w-100" src="{{ asset($imagePath) }}" alt="{{ $product->name }}"></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="exzoom_nav"></div>
                        <p class="exzoom_btn">
                            <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="far fa-chevron-left"></i>
                            </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="far fa-chevron-right"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_details_text">
                        <h2>{{ ucfirst($product->name) }}</h2>
                        <p class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                            <span>(201)</span>
                        </p>
                        <h3 class="price">
                            @if($product->offer_price > 0)
                                <h4 class="price" x-bind="totalSummary={{ $product->offer_price }}">${{ $product->offer_price }} <del>${{ $product->price }}</del> </h4>
                            @else
                                <h4 class="price" x-bind="totalSummary={{ $product->price }}">${{ $product->price }}</h4>
                            @endif
                        </h3>
                        <p class="short_description">{!! $product->short_description !!}</p>
                        @if($product->sizes()->exists())
                        <div class="details_size">
                            <h5>select size</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                       id="standart_option" checked value="0"
                                       @change="selectedSize = { id: null, price: 0 }">
                                <h6 class="form-check-label" for="standart_option">
                                    Standart <span>+ $0</span>
                                </h6>
                            </div>
                            @foreach($product->sizes as $size)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="size{{$size->id}}"
                                       value="{{ $size->price }}"
                                       @change="selectedSize={ id: {{$size->id}}, name: '{{$size->name}}', price: {{ (float) $size->price }} }">
                                <label class="form-check-label" for="size{{$size->id}}">
                                    {{ Str::words($size->name, 1, '') }} <span>+ {{ $size->price }} {{ $setting->value }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @if($product->options()->exists())
                        <div class="details_extra_item">
                            <h5>select option <span>(optional)</span></h5>
                            @foreach($product->options as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           value="{{ $option->price }}"
                                           id="option-{{ $option->id }}"
                                           @change="if ($event.target.checked) {
                                            checkedOptions.push(parseFloat($event.target.value));
                                            checkedOptionsId.push({{ $option->id }});
                                        } else {
                                            checkedOptions = checkedOptions.filter(price => price !== parseFloat($event.target.value));
                                            checkedOptionsId = checkedOptionsId.filter(id => id !== {{ $option->id }});
                                        }"
                                    >
                                    <h6 class="form-check-label" for="option-{{ $option->id }}">
                                        {{ Str::words($option->name, 1, '') }} <span>+ {{ $option->price }} {{ $setting->value }}</span>
                                    </h6>
                                </div>
                            @endforeach

                        </div>
                        @endif

                        <div class="details_quentity">
                            <h5>select quentity</h5>
                            <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                <div class="quentity_btn">
                                    <button class="btn btn-danger" @click="if (count > 1) count--"><i class="fal fa-minus"></i></button>
                                    <input type="text" placeholder="1" x-model="count">
                                    <button class="btn btn-success" @click="count++"><i class="fal fa-plus"></i></button>
                                </div>
                                <h3 x-text="((totalSummary + selectedSize.price) * count + getTotalOptionPrice()).toFixed(2)"></h3>
                            </div>
                        </div>
                        <ul class="details_button_area d-flex flex-wrap">
                            <li><button class="common_btn me-3"
                                wire:click="addToCart('{{ $product->id }}', count, summa, selectedSize.id, selectedSize.name, selectedSize.price, checkedOptionsId)"
                                >add to cart
                                </button>
                            </li>
                            <li><a class="wishlist" href="#"><i class="far fa-heart"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_description_area mt_100 xs_mt_70">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="menu_det_description">
                                    {!! $product->long_description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                 aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="fp__review_area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4>04 reviews</h4>
                                            <div class="fp__comment pt-0 mt_20">
                                                <div class="fp__single_comment m-0 border-0">
                                                    <img src="images/comment_img_1.png" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>Michel Holder <span>29 oct 2022 </span></h3>
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
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="images/chef_1.jpg" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>salina khan <span>29 oct 2022 </span></h3>
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
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="images/comment_img_2.png" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>Mouna Sthesia <span>29 oct 2022 </span></h3>
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
                                                    </div>
                                                </div>
                                                <div class="fp__single_comment">
                                                    <img src="images/chef_3.jpg" alt="review" class="img-fluid">
                                                    <div class="fp__single_comm_text">
                                                        <h3>marjan janifar <span>29 oct 2022 </span></h3>
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
                                                    </div>
                                                </div>
                                                <a href="#" class="load_more">load More</a>
                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fp__post_review">
                                                <h4>write a Review</h4>
                                                <form>
                                                    <p class="rating">
                                                        <span>select your rating : </span>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <input type="text" placeholder="Name">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <input type="email" placeholder="Email">
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <textarea rows="3"
                                                                      placeholder="Write your review"></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <button class="common_btn" type="submit">submit
                                                                review</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($relatedProducts) > 0)
            <div class="fp__related_menu mt_90 xs_mt_60">
                <h2>related item</h2>
                <div class="row related_product_slider">
                    @foreach($relatedProducts as $rproduct)
                    <div class="col-xl-3 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img">
                                <img src="{{ asset($rproduct->thumb_image) }}" alt="{{ $rproduct->name }}" class="img-fluid w-100">
                                <a class="category" href="#">{{ $rproduct->category->name }}</a>
                            </div>
                            <div class="fp__menu_item_text">
                                <p class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <span>74</span>
                                </p>
                                <a class="title" href="{{ route('product-details', ['slug' => $rproduct->slug]) }}" wire:navigate>{{ $rproduct->name }}</a>
                                <h5 class="price">
                                    @if($rproduct->offer_price > 0)
                                        ${{ $rproduct->offer_price }}<del>{{ $rproduct->price }}</del>
                                    @else
                                        ${{ $rproduct->price }}
                                    @endif
                                </h5>
                                <ul class="d-flex flex-wrap justify-content-center">
                                    <li><a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#cartModal"
                                           wire:click="getProduct({{ $product->id }})"
                                        ><i
                                                class="fas fa-shopping-basket"></i></a></li>
                                    <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
