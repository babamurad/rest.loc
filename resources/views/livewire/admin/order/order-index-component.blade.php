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
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($orders)
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <a href="#" class="badge badge-primary">#-{{ $order->invoice_id  }}</a>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ $order->user->name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $order->product_qty  }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">{{ $order->grand_total }} m.</span>
                                    </td>
                                    <td>
                                        @if($order->payment_status == 'COMPLETED')
                                            <span class="badge badge-success">COMPLETED</span>
                                        @elseif($order->payment_status == 'PENDING')
                                            <span class="badge badge-warning">{{ ucfirst($order->payment_status) }}</span>
                                        @else
                                            <span class="badge badge-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ \Carbon\Carbon::create($order->created_at)->format('d.m.Y') }}</span>
                                    </td>
                                    <td class="text-center" style="width: 10%;">
                                        <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}" class="btn btn-icon btn-primary btn-sm">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-warning btn-sm">
                                            <i class="fas fa-truck-loading"></i>
                                        </a>
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

    <div wire:ignore class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="ConfirmDelete" aria-hidden="true" style="background-color: rgb(70 70 70 / 50%);">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ConfirmDelete">Удаление</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close"></button>
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Вы действительно хотите удалить?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" wire:click="destroy">Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- /Modal -->

</section>
