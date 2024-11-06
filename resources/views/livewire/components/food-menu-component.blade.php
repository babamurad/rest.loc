<section class="fp__menu mt_95 xs_mt_65">

    <script>
        window.addEventListener('show-modal', event => {
            $('#cartModal').modal('show');
        });
        window.addEventListener('close-modal', event => {
            $('#cartModal').modal('hide');
        });
        /*document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('show-modal', event => {
                const modalElement = new bootstrap.Modal(document.getElementById('cartModal'));
                modalElement.show();
            });
        });*/

    </script>

{{--    @if($showModal)--}}
<!-- Modal -->
    <div wire:ignore.self class="fp__cart_popup">
        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeModal">
                            <i class="fas fa-times"></i>
                        </button>

                        <!-- Изображение товара -->
                        <div class="fp__cart_popup_img">
                            <img src="{{ asset($showModal ? $prod->thumb_image : '') }}" alt="{{ $showModal ? $prod->name : '' }}" class="img-fluid w-100">
                        </div>

                        <!-- Контент модального окна -->
                        <div class="fp__cart_popup_text"
                             x-data="{
                             basePrice: @if($showModal) {{ $prod->offer_price ? $prod->offer_price : $prod->oprice }} @endif,
                             sizePrice: 0,
                             optionsPrice: 0,
                             quantity: 1,
                             calculateTotal() {
                                 return (this.basePrice + this.sizePrice + this.optionsPrice) * this.quantity;
                             }
                         }">

                            <a href="#" class="title">{!! $showModal ? $prod->name : '' !!}</a>
                            <p class="rating">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>
                                <span>(201)</span>
                            </p>
                            <h4 class="price" x-text="`$${calculateTotal().toFixed(2)}`"></h4>

                            <!-- Выбор размера -->
                            <div class="details_size">
                                <h5>Выберите размер</h5>
                                @if($showModal)
                                    @foreach($prod->sizes as $size)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="size"
                                                   @click="sizePrice = {{ $size->price }}"
                                                   id="size{{ $size->id }}">
                                            <label class="form-check-label" for="size{{ $size->id }}">
                                                {{ Str::words($size->name, 1, '') }} + ${{ $size->price }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Выбор опций -->
                            <div class="details_extra_item">
                                <h5>Выберите опции <span>(опционально)</span></h5>
                                @if($showModal)
                                    @foreach($prod->options as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   @click="optionsPrice += $event.target.checked ? {{ $option->price }} : -{{ $option->price }}"
                                                   id="option{{ $option->id }}">
                                            <label class="form-check-label" for="option{{ $option->id }}">
                                                {{ Str::words($option->name, 1, '') }} + ${{ $option->price }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Выбор количества -->
                            <div class="details_quentity">
                                <h5>Количество</h5>
                                <div class="quentity_btn_area d-flex align-items-center">
                                    <button class="btn btn-danger" @click="if (quantity > 1) quantity--"><i class="fal fa-minus"></i></button>
                                    <span class="mx-2" x-text="quantity"></span>
                                    <button class="btn btn-success" @click="quantity++"><i class="fal fa-plus"></i></button>
                                </div>
                            </div>

                            <!-- Общая сумма -->
                            <h4>Общая сумма: <span x-text="`$${calculateTotal().toFixed(2)}`"></span></h4>

                            <!-- Кнопка добавления в корзину -->
                            <ul class="details_button_area d-flex flex-wrap">
                                <li><a class="common_btn" href="#">Добавить в корзину</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    {{--    @endif--}}

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
                                    {{ $product->offer_price }} {{ $setting->value }}
                                    <del>{{ $product->price }}{{ $setting->value }}</del>
                                @else
                                    ${{ $product->price }}
                                @endif
                            </h5>
                            <ul class="d-flex flex-wrap justify-content-center">
                                <li><a wire:click="openModal({{ $product->id }})" style="color: white; cursor: pointer;"><i class="fas fa-shopping-basket"></i></a></li>
                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-eye"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</section>
