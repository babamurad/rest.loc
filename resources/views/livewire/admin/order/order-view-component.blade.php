<section class="section">
    <div id="sect-head" class="section-header">
        <h1>Invoice</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Invoice</div>
        </div>
    </div>

    <div class="section-body">
        <div class="invoice">
            <div id="invoice-print" class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Invoice</h2>
                            <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Deliver To:</strong><br>
                                    <strong>Name:</strong> {{ $order->address->first_name }} {{ $order->address->last_name }} <br>
                                    <strong>Phone: {{ $order->address->phone }}</strong><br>
                                    <strong>Address:{{ $order->address->address }}</strong><br>
                                    <strong>Area: {{ $order->address->deliveryArea->area_name }}
                                    </strong>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    {{ \Carbon\Carbon::create($order->created_at)->format('F d, Y / H:i') }}<br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    {{ $order->payment_method }}<br>
                                    <strong>Payment Status:</strong>
                                    @if($order->payment_status == 'DELIVERED')
                                        <span class="badge badge-success">COMPLETED</span>
                                    @elseif($order->payment_status == 'PENDING')
                                        <span class="badge badge-warning">{{ ucfirst($order->payment_status) }}</span>
                                    @elseif($order->payment_status == 'DECLINE')
                                        <span class="badge badge-danger">Declined</span>
                                    @endif
                                </address>
                            </div>
                            <div class="col-md-6 col-sm-6 text-md-right">
                                <address>
                                    <strong>Order Status:</strong>
                                    @if($order->order_status == 'COMPLETED')
                                        <span class="badge badge-success">COMPLETED</span>
                                    @elseif($order->order_status == 'PENDING')
                                        <span class="badge badge-warning">{{ ucfirst($order->order_status) }}</span>
                                    @else
                                        <span class="badge badge-danger">Declined</span>
                                    @endif
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">Order Summary</div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th data-width="40">#</th>
                                    <th>Item</th>
                                    <th>Size&Options</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Totals</th>
                                </tr>

                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>
                                        {{ ucfirst($item->product_name) }}
                                    </td>
                                    <td>
                                        <ul>
                                            <li><span>Size: {{ @json_decode($item->product_size)->name }}</span>
                                                <span>{{ @json_decode($item->product_size)->price }} m.</span></li>
                                            @php $optSum = 0; @endphp
                                            @foreach(json_decode($item->product_option) as $option)
                                                <li>{{ $option->name }}: {{ $option->price }} m.</li>
                                                @php $optSum += $option->price @endphp
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">{{ $item->unit_price }} m.</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-right">{{ $optSum + ($item->unit_price + @json_decode($item->product_size)->price) * $item->qty }} m.</td>

                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-8">
                                @include('livewire.admin.components.alerts')
                                <div class="col-md-4">
                                    <form wire:submit.prevent="update">
                                        <div class="form-group">
                                            <label for="payment_status">Payment Status</label>
                                            <select class="form-control" name="payment_status" id="payment_status" wire:model="payment_status">
                                                <option value="pending">Pending</option>
                                                <option value="completed">Completed</option>
                                            </select>
                                            @error('payment_status') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="order_status">Order Status</label>
                                            <select class="form-control @error('order_status') is-invalid @enderror" wire:model="order_status">
                                                <option value="PENDING">Pending</option>
                                                <option value="IN_PROCESS">In process</option>
                                                <option value="DELIVERED">Delivered</option>
                                                <option value="DECLINED">Declined</option>
                                            </select>
                                            @error('order_status') <div class="invalid-feedback d-block">{{$message}}</div> @enderror
                                        </div>
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </form>
                                </div>
                                <div class="invoice-detail-item mt-3">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg"><strong>{{ ucfirst(\App\Helpers\CalcCart::propis($order->grand_total)) }}</strong></div>
                                </div>

                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Subtotal</div>
                                    <div class="invoice-detail-value">{{ $order->subtotal }} m.</div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Shipping</div>
                                    <div class="invoice-detail-value">{{ $order->delivery_charge ?? 0 }} m.</div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Discount</div>
                                    <div class="invoice-detail-value"><span class="text-danger">{{ @json_decode($order->coupon_info)->discount? @json_decode($order->coupon_info)->discount . ' %' : '' }}</span> {{ $order->discount }} m.</div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg"><strong>{{ $order->grand_total }} m.</strong></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-info btn-icon icon-left"><i class="fas fa-arrow-left"></i> {{__('Back')}}</a>
                </div>
                <button id="action-print" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
    <style>
        @media print{
            .main-sidebar{
                display: none;
            }
            #action-print{
                display: none;
            }
            .navbar-bg{
                display: none;
            }
            .section-header{
                display: none;
                margin-bottom: 0px;
            }
            #sect-head{
                display: none;
            }
            .btn{
                display: none;
            }
            .main-footer{
                display: none;
            }
            .invoice{
                margin-top: 0px;
                padding-top: 0px;
                padding-right: 0px;
            }

        }
    </style>
</section>

@script
<script>
    $(function($){
        $("#action-print").click(function(){
            window.print();
            return false;
        });
    });
</script>
@endscript

