<div class="mt-5 pt-5">

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
             x-data="totalSummary : 0"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $product->name }} {{ $product->price }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>select size</h5>
                        @foreach($product->sizes as $size)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                       id="size-{{$size->id}}"
                                       wire:model.live="sizePrice"
                                       value="{{ $size->price }}"
                                       wire:click="selectSize({{$size->price}})"
                                       @if ($size->id == $sizeId) checked @endif
                                >
                                <h6 class="form-check-label" for="size-{{$size->id}}">
                                    {{ Str::words($size->name, 1, '') }} <span>+ ${{ $size->price }}</span>
                                </h6>
                            </div>
                        @endforeach
                        <h5 class="mt-1">select options</h5>
                        @foreach($product->options as $option)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="coca-cola">
                                <h6 class="form-check-label" for="coca-cola">
                                    {{ Str::words($option->name, 1, '') }} <span>+ ${{ $option->price }}</span>
                                </h6>
                            </div>
                        @endforeach
                        <span wire:modal="price">{{ $product->price }}</span>
                        <span wire:modal="sumTotal">{{ $sumTotal }}</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    <ul>

    @foreach($products as $product)
        <li>
            <span class="mx-2">{{ $product->name }}</span>
            <span class="mx-2">Price: {{ $product->price }}</span>
            <span class="mx-2">qty:{{ $product->qty }}</span>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click="getProduct({{ $product->id }})">
                <i class="far fa-eye"></i>
            </button>
        </li>
    @endforeach
    </ul>



</div>
