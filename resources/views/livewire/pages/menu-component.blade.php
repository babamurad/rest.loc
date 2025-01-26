<div
x-data="{
    totalSummary: 0,
    selectedSize: { id: null, name: '', price: 0 },
    checkedOptions: [],
    checkedOptionsId: [],
    summa : 0,
    count : 1,
    sizeId: 0,
    showModal: @entangle('showModal'),
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
@keydown.escape.window="showModal = false"
>

    <!-- CART POPUT START -->
    <div class="fp__cart_popup">
        <div x-show="showModal" class="modal-backdrop" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
        <div x-show="showModal" 
             class="modal fade"
             :class="{ 'show': showModal }" 
             {{-- :style="{ 'display': showModal ? 'block' : 'none' }"   --}}
             @if ($showModal)
               style="display: block;"
               @else
               style="display: none;"  
             @endif           
             {{-- @click.away="showModal = false"
             @keydown.escape.window="showModal = false" --}}
             >
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
                                                @if(!$showModal)
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                                @endif
                                                wire:click="addToCart('{{ $product->id }}', count, summa, selectedSize.id, selectedSize.name, selectedSize.price, checkedOptionsId)"
                                                {{-- wire:loading.attr="disabled" --}}
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
    <!--=============================
        BREADCRUMB START
    ==============================-->
    <section class="fp__breadcrumb" style="background: url({{ asset('assets/images/counter_bg.jpg') }});">
        <div class="fp__breadcrumb_overlay">
            <div class="container">
                <div class="fp__breadcrumb_text">
                    <h1>Foods menu</h1>
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><a href="javascript:;">menu</a></li>
                        <span x-text="showModal"></span>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        BREADCRUMB END
    ==============================-->


    <!--=============================
        MENU PAGE START
    ==============================-->
    <section class="fp__search_menu mt_120 xs_mt_90 mb_100 xs_mb_70">
        <div class="container">
            <form class="fp__search_menu_form">
                <div class="row">
                    <div class="col-xl-6 col-md-5">
                        <input type="text" placeholder="Search..." wire:model.live="search">
                    </div>
                    <div class="col-xl-6 col-md-4">
                        <div x-data="{ isOpen: @entangle('isOpen').defer }">
                            <div @click="isOpen = !isOpen" class="custom-select d-flex justify-content-between">
                              <span>{{ $categoryName?? "Select Category" }}</span> 
                              <i class="fa fa-chevron-down mt-1" :class="{ 'rotate-180': isOpen }"></i>
                            </div>
                            <ul x-show="isOpen" class="dropdown-category"
                                x-transition:enter="transition ease-out duration-300" 
                                x-transition:enter-start="opacity-0 transform scale-y-0" 
                                x-transition:enter-end="opacity-100 transform scale-y-100" 
                                x-transition:leave="transition ease-in duration-300" 
                                x-transition:leave-start="opacity-100 transform scale-y-100" 
                                x-transition:leave-end="opacity-0 transform scale-y-0">
                                <li wire:click="resetCategory" @click="isOpen =false"> <b>Select Category</b> </li>
                                @foreach($categories as $category)
                                  <li wire:click="selectCategory({{ $category->id }})" @click="isOpen =false">{{ Str::ucfirst($category->name) }} <span>{{ $category->products->count() }}</span> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </form>
            
            <div class="row">
                @foreach($products as $product)
                    <div class="col-xl-3 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                        <div class="fp__menu_item">
                            <div class="fp__menu_item_img">
                                <img src="{{ asset($product->thumb_image) }}" alt="menu" class="img-fluid w-100">
                                <a class="category" href="{{ route('menu', ['id' => $product->category->id]) }}">{{ $product->category->name }}</a>
                            </div>
                            <div class="fp__menu_item_text">
                                <p class="rating">
                                    @for($i = 0; $i < 5; $i++)
                                        @if($i < $product->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                    <span>{{ $product->rating }}</span>
                                </p>
                                <a class="title" href="{{ route('product-details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                <h5 class="price">
                                    @if($product->offer_price > 0)
                                    {{ $product->offer_price }} {{ $setting?->value ?? '$' }}
                                    <del>{{ $product->price }}{{ $setting?->value ?? '$' }}</del>
                                    @else
                                        ${{ $product->price }}
                                    @endif
                                </h5>
                                <ul class="d-flex flex-wrap justify-content-center">
                                    <li><a href="javascript:;" wire:click="getProduct({{ $product->id }})"><i
                                                class="fas fa-shopping-basket"></i></a></li>
                                    <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                    <li><a href="#"><i class="far fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="fp__pagination mt_35">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
        MENU PAGE END
    ==============================-->
</div>
