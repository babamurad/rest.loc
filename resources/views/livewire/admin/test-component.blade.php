<div class="mt-5 pt-5">
    <script>
        window.addEventListener('close-modal', event => {
            $('#cartModal').modal('hide');
        });
    </script>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="cartModal" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
         wire:loading.class="d-none"
         wire:target="getProduct"
         x-data="{ totalSummary: 0, selectedSizePrice: 0, checkedOptions: [], option :0,
            summa : 0,
             getTotalOptionPrice() {
            // Calculate the total price of selected options
            let totalOptionPrice = 0;
            for (const option of this.checkedOptions) {
              totalOptionPrice += parseFloat(option); // Ensure number conversion
            }
            return totalOptionPrice;
          }
          }"
    >

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h5>Name: {{ $product->name }}</h5>
                        <h6>Price: <span x-model="totalSummary={{ (float) $product->price }}">{{ $product->price }}</span> </h6>
                    </div>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset($product->thumb_image) }}" alt="menu" class="img-fluid w-100">
                    <h5>select size</h5>
                    <p x-text="selectedSizePrice"></p>
                    @foreach($product->sizes as $size)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                   id="size-{{$size->id}}"
                                   value="{{ $size->price }}"
                                   x-model="selectedSizePrice={{ (float) $size->price }}">
                            <h6 class="form-check-label" for="size-{{$size->id}}">
                                {{ Str::words($size->name, 1, '') }} <span>+ ${{ $size->price }}</span>
                            </h6>
                        </div>
                    @endforeach
                    <h5 class="mt-1">select options</h5>
                    @foreach($product->options as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   value="{{ $option->price }}"
                                   id="option-{{ $option->id }}"
                                   x-model="checkedOptions"
{{--                                   @click="checkedOptions = $event.target.value"--}}
                            >
                            <h6 class="form-check-label" for="option-{{ $option->id }}">
                                {{ Str::words($option->name, 1, '') }} <span>+ ${{ $option->price }}</span>
                            </h6>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <p>TotalSummary: <span x-text="summa=((totalSummary + selectedSizePrice + getTotalOptionPrice())*count).toFixed(2)"></span></p>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="getTotal(summa)">Save</button>
                </div>
            </div>
        </div>
    </div>

    <ul x-data="{
    cartTotal: 0;
    calcCartTotal(rowSum) { this.cartTotal += rowSum }
    }">
        @foreach($cartProducts as $product)
            <li class="mt-1" x-data="{
            quantity: {{ $product->qty }},
            calculateTotal() {
                this.total = {{$product->price}} * this.quantity;
            },
            total: {{$product->price * $product->qty}}
                }">
                <span>{{ $product->rowId }}</span>
                <span class="mx-2">{{ $product->name }}</span>
                <span class="mx-2">{{ $product->price }}</span>
                <span class="mx-2">
                    <button class="btn btn-danger"
                            @click="if (quantity > 1) { quantity--; calculateTotal();}"
                            wire:click="qtyInc('{{ $product->rowId }}')"
                    >
                        <i class="fal fa-minus"></i></button>
                    <input type="text" x-model="quantity" @input="calculateTotal()" wire:model="qty">
                    <button class="btn btn-success" @click="quantity++; calculateTotal();"><i class="fal fa-plus"></i></button>
    </span>
                <span x-text="total"></span>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cartModal" wire:click="getProduct({{ $product->id }})">
                    <i class="far fa-eye"></i>
                </button>
            </li>
        @endforeach
        <p>Total cart: <span x-text="cartTotal"></span></p>
    </ul>

</div>
