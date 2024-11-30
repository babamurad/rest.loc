<section class="section">
    <div class="section-header">
        <h1>Invoice</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Invoice</div>
        </div>
    </div>

    <div class="section-body">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Invoice</h2>
                            <div class="invoice-number">Order #{{ $order->invoice_id }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Deliver To:</strong><br>
                                    <strong>Name:</strong>
                                    @foreach($order->user->addresses as $address)
                                        <span>
                                            {{ @$address->first_name . ' ' . @$address->last_name }}<br>
                                        </span>
                                        @break
                                    @endforeach
                                    <strong>Phone: </strong>
                                    @foreach($order->user->addresses as $address)
                                        <span>
                                            {{ $address->phone }}<br>
                                        </span>
                                        @break
                                    @endforeach
                                    <strong>Address:
                                        @foreach($order->user->addresses as $address)
                                            <span>
                                                {{ $address->address }}<br>
                                            </span>
                                        @break
                                        @endforeach
                                    </strong>
                                    <strong>Area: {{ $order->address->deliveryArea->area_name }}
                                    </strong>
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>

                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    {{ $order->payment_method }}<br>
                                    <strong>Payment Status:</strong>
                                    @if($order->payment_status == 'COMPLETED')
                                        <span class="badge badge-success">COMPLETED</span>
                                    @elseif($order->payment_status == 'PENDING')
                                        <span class="badge badge-warning">{{ ucfirst($order->payment_status) }}</span>
                                    @else
                                        <span class="badge badge-danger">Declined</span>
                                    @endif
                                </address>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    {{ \Carbon\Carbon::create($order->created_at)->format('F d, Y') }}<br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="section-title">Order Summary</div>
                        <p class="section-lead">All items here cannot be deleted.</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th data-width="40">#</th>
                                    <th>Item</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Totals</th>
                                </tr>
                                @php $sum = 0; @endphp
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ ucfirst($item->product_name) }}</td>
                                    <td class="text-center">{{ $item->unit_price }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-right">{{ @$item->unit_price * @$item->qty }}</td>
                                    @php $sum += $item->unit_price * $item->qty; @endphp
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-8">
                                <div class="section-title">Payment Method</div>
                                <p class="section-lead">The payment method that we provide is to make it easier for you to pay invoices.</p>
                                <div class="images">
                                    <img src="{{ asset('admin/assets/img/visa.png') }}" alt="visa">
                                    <img src="{{ asset('admin/assets/img/jcb.png') }}" alt="jcb">
                                    <img src="{{ asset('admin/assets/img/mastercard.png') }}" alt="mastercard">
                                    <img src="{{ asset('admin/assets/img/paypal.png') }}" alt="paypal">
                                </div>
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Subtotal</div>
                                    <div class="invoice-detail-value">${{ $sum }}</div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Shipping</div>
                                    <div class="invoice-detail-value">$15</div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">$685.99</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                    <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                    <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                </div>
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</section>

