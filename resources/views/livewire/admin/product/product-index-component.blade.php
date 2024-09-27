@push('tosastr-css')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/izitoast/css/iziToast.min.css') }}">
@endpush
@push('toastr-js')
    <!-- JS Libraies -->
    <script src="{{ asset('admin/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#toastr-5").click(function() {
                iziToast.show({
                    title: 'Hello, world!',
                    message: 'This awesome plugin is made by iziToast',
                    position: 'bottomRight'
                });
            });
        });
    </script>
@endpush
<section class="section">
    <div class="section-header">
        <h1>{{ __('Products') }}</h1>
    </div>
<p>{{$err}}</p>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('All Products') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>
                <div class="card-header-action">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-inline">
                                <div class="form-group">
                                    <label class="mr-2" for="perp">{{__('Show')}}</label>
                                    <select class="custom-select" id="perp" wire:model.live="perPage">
                                        <option selected="8">8</option>
                                        <option value="16">16</option>
                                        <option value="25">25</option>
                                        <option value="40">40</option>
                                    </select>
                                    <label class="ml-2">
                                        {{__('entries')}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-inline">
                                <div class="form-group">
                                    <label class="mr-2" for="cat" style="font-size: 1rem;">{{__('Category') }}</label>
                                    <select class="custom-select" id="cat" wire:model.live.debounce.250ms="selectedCat">
                                        <option value="" selected>{{__('Select Category')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" wire:key="{{$category->id}}">{{ ucfirst($category->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 offset-3">
                            <div class="input-group mt-2">
                                <input type="text" class="form-control" placeholder="Search" wire:model.live.debounce.250ms="search">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><a href="#" type="button" wire:click.prevent="sortType('categories.name')">@if($sortBy == 'categories.name'){!! $sortIcon !!}@else<i class="fas fa-sort mr-1 text-muted"></i>@endif</a>{{__('Category')}}</th>
                            <th scope="col">{{__('Image')}}</th>
                            <th scope="col"><a href="#" type="button" wire:click.prevent="sortType('name')">@if($sortBy == 'name'){!! $sortIcon !!}@else<i class="fas fa-sort mr-1 text-muted"></i>@endif</a>{{__('Name')}}</th>
                            <th scope="col"><a href="#" type="button" wire:click.prevent="sortType('show_at_home')">@if($sortBy == 'status') {!! $sortIcon !!} @else <i class="fas fa-sort mr-1 text-muted"></i>@endif</a>{{__('Show')}}<br>{{__(' at home')}}</th>
                            <th scope="col"><a href="#" type="button" wire:click.prevent="sortType('price')">@if($sortBy == 'price') {!! $sortIcon !!} @else <i class="fas fa-sort mr-2 text-muted"></i>@endif</a>{{__('Price')}}</th>
                            <th scope="col"><a href="#" type="button" wire:click.prevent="sortType('created_at')">@if($sortBy == 'created_at') {!! $sortIcon !!} @else <i class="fas fa-sort mr-1 text-muted"></i>@endif</a>{{__('Date')}}</th>
{{--                            <th scope="col">{{__('Date')}}<a href="#" type="button" wire:click.prevent="sortType('created_at')">@if($sortBy == 'created_at'){!! $sortIcon !!}@else<i class="fas fa-sort ml-1 text-muted"></i>@endif</a></th>--}}
                            <th scope="col" class="text-center">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = ($products->currentPage()-1)*$products->perPage();
                        @endphp
                        @if($products)
                            @foreach ($products as $product)
                                <tr wire:key="{{ $product->id }}">
                                    <th scope="row">{{ ++$i }}</th>
                                    <td><strong>{{ ucfirst($product->category->name) }}</strong></td>
                                    <td style="width: 25%;">
                                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                                            <img class="w-25 p-1 rounded-5" src="{{ asset($product->thumb_image) }}" alt="">
                                        </a>
                                    </td>
                                    <td style="width: 20%;">
                                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                                            {{ ucfirst($product->name)  }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($product->show_at_home)
                                            <span class="badge badge-success">{{__('Yes')}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('No')}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ $product->price }} m.</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ \Carbon\Carbon::create($product->created_at)->format('d.m.Y') }}</span>
                                    </td>
                                    <td class="text-center" style="width: 10%;">
                                        <a class="btn btn-icon btn-primary" href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ConfirmDelete" wire:click="deleteId({{ $product->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $products->links() }}
                    @if(!$products)
                        <p>No items found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('closeModal', event=> {
            $('#ConfirmDelete').modal('hide');
        })
    </script>

    <!-- Modal -->

    <div wire:ignore class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="ConfirmDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ConfirmDelete">{{__('Удаление')}}</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('Вы действительно хотите удалить?')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">{{__('Отмена')}}</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" wire:click="destroy">{{__('Удалить')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /Modal -->

</section>
