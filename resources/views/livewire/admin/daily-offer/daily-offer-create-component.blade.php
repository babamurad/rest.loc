<section class="section">
    <div class="section-header">
        <h1>{{__('Daily Offer')}}</h1>
        @include('livewire.admin.components.alerts')
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{__('Create Daily Offer')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>{{__('Search')}}</label>
                            <input type="text" wire:model.live="search" placeholder="Поиск продукта" class="form-control">
                            <ul>
                                @foreach($filteredProducts as $product)
                                    <li class="product-item" style="cursor: pointer;" wire:click="addProduct({{ $product->id }})">
                                        <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="mr-2" width="42">
                                        <span>{{ $product->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <p>Выбран: {{ ucfirst($name) }}</p>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>{{__('Status')}}</label>
                                <select class="form-control @error('status') is-invalid @enderror"  wire:model="status">
                                    <option value="1" selected>{{__('Active')}}</option>
                                    <option value="0">{{__('Inactive')}}</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="create">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</section>

@push('select2-css')
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/select2/dist/css/select2.min.css') }}">
    <style>
        .product-item {
            /* Базовые стили */
            color: #333;
            cursor: pointer;
            display: flex; /* Создаем гибкий контейнер для выравнивания элементов */
            align-items: center; /* Выравниваем элементы по вертикали по центру */
        }

        .product-item:hover {
            background-color: #f0f0f0;
            color: #007bff;
        }
    </style>
@endpush

@push('select2-js')
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#product_search').select2();
        });
    </script>
@endpush
