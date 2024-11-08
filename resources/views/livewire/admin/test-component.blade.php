<div class="mt-5 pt-5">


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
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
{{--        <script>
            function getTotalOptionPrice() {
                return this.checkedOptions.reduce((total, price) => total + parseFloat(price), 0);
            }
        </script>--}}
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
                    <span wire:modal="price">{{ $product->price }}</span>
                    <span wire:modal="sumTotal">{{ $sumTotal }}</span>
                </div>
                <div class="modal-footer">
                    <p>TotalSummary: <span x-text="summa=(totalSummary + selectedSizePrice + getTotalOptionPrice()).toFixed(2)"></span></p>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="getTotal(summa)">Save</button>
                </div>
            </div>
        </div>
    </div>

    <ul>
        @foreach($products as $product)
            <li class="mt-1">
                <span class="mx-2">{{ $product->name }}</span>
                <span class="mx-2">{{ $product->price }}</span>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" wire:click="getProduct({{ $product->id }})">
                    <i class="far fa-eye"></i>
                </button>
            </li>
        @endforeach
    </ul>


    <div class="container" x-data="{ hidden: false }">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mt-5 bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Pricing</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a @click.outside="hidden = false" class="nav-link dropdown-toggle text-white" href="#" @click.stop.prevent="hidden = !hidden">
                                Dropdown link
                            </a>
                            <ul  x-bind:class="{ 'show': hidden }" class="dropdown-menu">
                                <li><a @click="hidden = false" class="dropdown-item" href="#">Action</a></li>
                                <li><a @click="hidden = false" class="dropdown-item" href="#">Another action</a></li>
                                <li><a @click="hidden = false" class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

</div>
