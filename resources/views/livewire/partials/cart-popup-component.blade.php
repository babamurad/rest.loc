<!-- CART POPUT START -->
<div class="fp__cart_popup">
    <div wire:ignore.self class="modal fade"
         id="cartModal" tabindex="-1" aria-hidden="true"
         wire:loading.class="d-none"
         wire:target="getProduct">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fal fa-times"></i></button>
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
