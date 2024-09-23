
<section class="section">
    <div class="section-header">
        <h1>{{ __('Products') }}</h1>
    </div>
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
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('Image')}}</th>
                            <th scope="col">{{__('Name')}}</th>
                            <th scope="col">{{__('Status')}}</th>
                            <th scope="col">{{__('Price')}}</th>
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
                                        @if ($product->status)
                                            <span class="badge badge-success">{{__('Active')}}</span>
                                        @else
                                            <span class="badge badge-danger">{{__('Inactive')}}</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge badge-light">{{ $product->price }} m.</span>
                                    </td>
                                    <td class="text-center" style="width: 10%;">
                                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-icon btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        {{--                                    </td>--}}
                                        {{--                                    <td class="text-left" style="width: 6%;">--}}
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
