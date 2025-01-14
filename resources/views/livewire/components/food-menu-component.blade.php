<section class="fp__menu mt_95 xs_mt_65"
         x-data="{
             totalSummary: 0,
             selectedSize: { id: null, name: '', price: 0 },
             checkedOptions: [],
             checkedOptionsId: [],
             summa : 0,
             count : 1,
             sizeId: 0,
             showModal: false,
             isModalOpen: @entangle('isModalOpen'),
             isModalOpen2: @entangle('isModalOpen2'),
             getTotalOptionPrice() {
                let totalOptionPrice = 0;
                for (const option of this.checkedOptions) {
                    totalOptionPrice += parseFloat(option);
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
         @shown.bs.modal="resetVariables()",
         @keydown.escape.window="isModalOpen = false"
>


    <!-- CART POPUT START -->
    <div class="fp__cart_popup">
        <div x-show="showModal" class="modal-backdrop" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
        <div class="loader loader--style6 preloader" wire:loading.delay>
            {{--     wire:loading.delay--}}
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                <rect x="0" y="13" width="4" height="5" fill="#333">
                    <animate attributeName="height" attributeType="XML"
                             values="5;21;5"
                             begin="0s" dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="y" attributeType="XML"
                             values="13; 5; 13"
                             begin="0s" dur="0.6s" repeatCount="indefinite" />
                </rect>
                    <rect x="10" y="13" width="4" height="5" fill="#333">
                        <animate attributeName="height" attributeType="XML"
                                 values="5;21;5"
                                 begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                        <animate attributeName="y" attributeType="XML"
                                 values="13; 5; 13"
                                 begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                    <rect x="20" y="13" width="4" height="5" fill="#333">
                        <animate attributeName="height" attributeType="XML"
                                 values="5;21;5"
                                 begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                        <animate attributeName="y" attributeType="XML"
                                 values="13; 5; 13"
                                 begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
              </svg>
        </div>
        <div x-show="showModal" 
             class="modal fade" tabindex="-1" aria-hidden="true"
             :class="{ 'show': showModal }" 
             :style="{ 'display': showModal ? 'block' : 'none' }"             
             @click.away="showModal = false"
             @keydown.escape.window="showModal = false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" @click="showModal = false"><i class="fal fa-times"></i></button>
                        @if($product)
                            <div class="fp__cart_popup_img">
                                <img src="{{ $product->thumb_image }}" alt="{{ $product->name }}" class="img-fluid w-100">
                            </div>
                            <div class="fp__cart_popup_text">
                                <a href="{{ route('product-details', ['slug' => $product->slug]) }}" class="title">{{ $product->name }}</a>
                                <p class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <span>(201)</span>
                                </p>
                                @if($product->offer_price)
                                    <h4 class="price" x-bind="totalSummary={{ $product->offer_price }}">${{ $product->offer_price }} <del>${{ $product->price }}</del> </h4>
                                @else
                                    <h4 class="price" x-bind="totalSummary={{ $product->price }}">${{ $product->price }}</h4>
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
                                    @if($product->sizes->count() > 0)
                                    @foreach($product->sizes as $size)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                   id="size-{{$size->id}}"
                                                   value="{{ $size->price }}"
                                                   @change="selectedSize={ id: {{$size->id}}, name: '{{$size->name}}', price: {{ (float) $size->price }} }"
                                                   >
                                            <h6 class="form-check-label" for="size-{{$size->id}}">
                                                {{ Str::words($size->name, 1, '') }} <span>+ {{ $size->price }} man.</span>
                                            </h6>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="details_extra_item">
                                    <h5>select option <span>(optional)</span></h5>
                                    @if($product->options->count() > 0)
                                    @foreach($product->options as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   value="{{ $option->price }}"
                                                   id="option-{{ $option->id }}"
                                                   x-model="checkedOptions"
                                                   @change="checkedOptionsId.push({{$option->id}})"
                                                   >
                                            <h6 class="form-check-label" for="option-{{ $option->id }}">
                                                {{ $option->name }} <span>+ {{ $option->price }} man.</span>
                                            </h6>
                                        </div>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="details_quentity" x-data="{showQty:false}">
                                    <h5>select quentity</h5>
                                    <div class="quentity_btn_area d-flex flex-wrapa align-items-center">
                                        <div class="quentity_btn">
                                            <button class="btn btn-danger" @click="if (count > 1) count--"><i class="fal fa-minus"></i></button>
                                            <input type="text"  x-model="count">
                                            <button class="btn btn-success" @click="if (count < {{ $product->quantity }}) { count++; showQty = false; } else { showQty = true; }"><i class="fal fa-plus"></i></button>
                                        </div>
                                        <h3><span x-text="summa=((totalSummary + selectedSize.price) * count + getTotalOptionPrice()).toFixed(2)"></span></h3>
                                    </div>
                                    <template x-if="showQty">
                                        <p class="text-danger">{{ __('Stock out') }}</p>
                                    </template>
                                </div>
                                <ul class="details_button_area d-flex flex-wrap">
                                    <li>
                                        @if($product->quantity > 0)
                                        <button class="common_btn"
                                                @if($closeModal)
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                                @endif
                                                wire:click="addToCart('{{ $product->id }}', count, summa, selectedSize.id, selectedSize.name, selectedSize.price, checkedOptionsId)"
                                                wire:loading.attr="disabled"
                                        >
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" wire:loading></span>
                                            <span class="text-white" wire:loading.remove>add to cart</span>
                                            <span class="text-white" wire:loading>Loading...</span>
                                        </button>
                                        @else
                                            <button class="common_btn bg-secondary" >
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" wire:loading></span>
                                                <span class="text-white" wire:loading.remove>{{ __('Stock out') }}</span>
                                                <span class="text-white" wire:loading>Loading...</span>
                                            </button>
                                        @endif

                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="text-center">
                                <p>{{ __('Product not found') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CART POPUT END -->

    {{-- @include('components.layouts.preloader') --}}
    <div class="container">
        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                <div class="fp__section_heading mb_45">
                    <h4>food Menu</h4>
                    <h2>Our Popular Delicious Foods</h2>
                    <span>
                            <img src="{{ asset('assets/images/heading_shapes.png') }}" alt="shapes" class="img-fluid w-100">
                        </span>
                    <p>Objectively pontificate quality models before intuitive information. Dramatically
                        recaptiualize multifunctional materials.</p>
                </div>
            </div>
        </div>

        <div class="row wow fadeInUp" data-wow-duration="1s">
            <div class="col-12">
                <div class="menu_filter d-flex flex-wrap justify-content-center">
                    <button class=" active" data-filter="*">all menu</button>
                    @foreach($categories as $category)
                        <button data-filter=".{{ $category->name }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row grid">
            @foreach($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4 {{ $product->category->name }} wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__menu_item">
                        <div class="fp__menu_item_img">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100">
                            <a class="category" href="#">{{ $product->category->name }}</a>
                        </div>
                        <div class="fp__menu_item_text">
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="far fa-star"></i>
                                <span>10</span>
                            </p>
                            <a class="title" href="{{ route('product-details', ['slug' => $product->slug]) }}" wire:navigate>{{ $product->name }}</a>
                            <h5 class="price">
                                @if($product->offer_price > 0)
                                    {{ $product->offer_price }} {{ $setting?->value ?? '$' }}
                                    <del>{{ $product->price }}{{ $setting?->value ?? '$' }}</del>
                                @else
                                    ${{ $product->price }}
                                @endif
                            </h5>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a
                                        href="javascript:;"
                                        @click="resetVariables(); showModal = true"
                                        wire:click="getProduct({{ $product->id }})">
                                        <i class="fas fa-shopping-basket"></i></a>
                                </li>
                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>      

    </div>

    

    @push('modal')
        
    @endpush
    <style>
        
        .show{
            display: block !important;
            background-color: 
        }
        .toast {
            z-index: 849;
        }
    </style>
</section>