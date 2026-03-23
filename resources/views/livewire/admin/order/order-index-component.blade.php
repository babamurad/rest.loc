<section class="section">
    <div class="section-header">
        <h1>{{ __('Orders') }}</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('All Orders') }}</h4>

                </div>
                <div class="card-header-action mt-3">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-inline">
                                <div class="form-group">
                                    <label class="mr-2" for="perp">{{__('Show')}}</label>
                                    <select class="custom-select" id="perp" wire:model.live="perPage">
                                        <option selected value="8">8</option>
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
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Invoice') }}</th>
                            <th scope="col">{{ __('User Name') }}</th>
                            <th scope="col">{{ __('Qty') }}</th>
                            <th scope="col">{{ __('Total') }}</th>
                            <th scope="col">{{ __('Payment Status') }}</th>
                            <th scope="col">{{ __('Order Status') }}</th>
                            <th scope="col">{{ __('Date') }}</th>
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($orders)
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" class="badge badge-primary">#-{{ $order->invoice_id  }}</a>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ $order->address->first_name . ' ' . $order->address->last_name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $order->product_qty  }}</span>
                                    </td>
                                    <td>
                                        <span class="badge text-danger">{{ $order->grand_total }} {{ __('manat') }}</span>
                                    </td>
                                    <td>
                                        @if($order->payment_status == 'COMPLETED')
                                            <span class="badge badge-success">{{ __('Completed') }}</span>
                                        @elseif($order->payment_status == 'PENDING')
                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->order_status == 'COMPLETED')
                                            <span class="badge badge-success">{{ __('Completed') }}</span>
                                        @elseif($order->order_status == 'PENDING')
                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                        @elseif($order->order_status == 'DECLINED')
                                            <span class="badge badge-danger">{{ __('Declined') }}</span>
                                        @elseif($order->order_status == 'IN_PROCESS')
                                            <span class="badge badge-info">{{ __('In process') }}</span>
                                         @elseif($order->order_status == 'DELIVERED')
                                            <span class="badge badge-success">{{ __('Delivered') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ \Carbon\Carbon::create($order->created_at)->format('d.m.Y') }}</span>
                                    </td>
                                    <td class="text-center" style="width: 10%;">
                                        <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" class="btn btn-icon btn-primary btn-sm">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <button href="#" class="btn btn-warning btn-sm" wire:click="showStatusModal({{ $order->id }})">
                                            <i class="fas fa-truck-loading"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ConfirmDelete" wire:click="deleteId({{ $order->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                    @if(!$orders)
                        <p>{{ __('No items found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('closeModal', event=> {
            $('#ConfirmDelete').modal('hide');
        })

        window.addEventListener('show-update-modal', event=> {
            $('#orderStatus').modal('show');
        })
        window.addEventListener('close-update-modal', event=> {
            $('#orderStatus').modal('hide');
        })
    </script>


    <!-- Modal -->
    <div wire:ignore class="modal fade" id="orderStatus" tabindex="-1" role="dialog" aria-labelledby="orderStatusLabel" aria-hidden="true" style="background-color: rgb(70 70 70 / 30%);">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderStatusLabel">{{ __('Order Status Update') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="payment_status">{{ __('Payment Status') }}</label>
                            <select class="form-control" name="payment_status" id="payment_status" wire:model="payment_status">
                                <option value="PENDING">{{ __('Pending') }}</option>
                                <option value="COMPLETED">{{ __('Completed') }}</option>
                            </select>
                            @error('payment_status') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label for="order_status">{{ __('Order Status') }}</label>
                            <select class="form-control @error('order_status') is-invalid @enderror" wire:model="order_status">
                                <option value="PENDING">{{ __('Pending') }}</option>
                                <option value="IN_PROCESS">{{ __('In process') }}</option>
                                <option value="DELIVERED">{{ __('Delivered') }}</option>
                                <option value="DECLINED">{{ __('Declined') }}</option>
                            </select>
                            @error('order_status') <div class="invalid-feedback d-block">{{$message}}</div> @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" class="btn btn-primary" wire:click="update">{{ __('Update') }}</button>
                </div>
            </div>
        </div>
    </div>

{{--    close-update-modal--}}

    <!-- Modal -->

    <div wire:ignore class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="ConfirmDelete" aria-hidden="true" style="background-color: rgb(70 70 70 / 30%);">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ConfirmDelete">{{ __('Удаление') }}</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Вы действительно хотите удалить?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">{{ __('Отмена') }}</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" wire:click="destroy">{{ __('Удалить') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /Modal -->

</section>
