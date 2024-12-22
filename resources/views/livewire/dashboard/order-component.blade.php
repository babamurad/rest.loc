<div class="tab-pane fade"  x-show="activeTab === 'order-list'"
     :class="activeTab === 'order-list' ? 'tab-pane fade active show' : 'tab-pane fade'"
>
    <div class="fp_dashboard_body"  x-data="{viewOrder: @entangle('viewOrder')}">
        <h3>order list</h3>
        @include('components.layouts.preloader')
        <div class="fp_dashboard_order" x-show="!viewOrder">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr class="t_header">
                        <th>Order</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <h5>#{{ $order->invoice_id }}</h5>
                            </td>
                            <td>
                                <p>{{ \Carbon\Carbon::create($order->created_at)->format('F d, Y') }}</p>
                            </td>
                            <td>
                                @if($order->order_status == 'IN_PROCESS')
                                <span class="active">{{ $order->order_status }}</span>
                                @elseif($order->order_status == 'PENDING')
                                <span class="complete">{{ $order->order_status }}</span>
                                @elseif($order->order_status == 'DECLINED')
                                <span class="cancel">{{ $order->order_status }}</span>
                                @elseif($order->order_status == 'DELIVERED')
                                <span class="complete">{{ $order->order_status }}</span>
                                @endif
                            </td>
                            <td>
                                <h5>{{ $order->grand_total }} m.</h5>
                            </td>
                            <td><a class="view_invoice" @click="$wire.invoice({{ $order->id }}); viewOrder=true;">View Details</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    {{-- {{ $orders->links('components.simple-bootstrap') }} --}}

        
    @if($selectOrder)
        <div class="fp__invoice invoice-print" x-show="viewOrder">
            <a class="go_back" @click="viewOrder=false"><i class="fas fa-long-arrow-alt-left"></i> go back</a>
            <div class="fp__track_order">
                <ul>
                    @if($selectOrder->order_status === 'DECLINED')
                    <li class=" decline_status {{ in_array($selectOrder->order_status, ['DECLINED']) ? 'active' : '' }}">order declined</li>
                    @else
                    <li class="{{ in_array($selectOrder->order_status, ['PENDING', 'IN_PROCESS', 'DELIVERED', 'DECLINED']) ? 'active' : '' }}">order pending</li>
                    <li class="{{ in_array($selectOrder->order_status, ['IN_PROCESS', 'DELIVERED', 'DECLINED']) ? 'active' : '' }}">order process</li>
                    <li class="{{ in_array($selectOrder->order_status, ['DELIVERED']) ? 'active' : '' }}">order delivered</li>
                    @endif
                </ul>
            </div>
            <div class="fp__invoice_header">
                <div class="header_address">
                    <h4>invoice to</h4>
                    <p>{{ $selectOrder->address->address }}</p>
                    <p>{{ $selectOrder->address->deliveryArea->area_name }}</p>
                    <p>{{ $selectOrder->address->phone }}</p>
                </div>
                <div class="header_address" style="width: 40%;">
                    <p><b style="width: 140px;">invoice no: </b><span>#{{ $selectOrder->invoice_id }}</span></p>
                    <p><b style="width: 140px;">Payment status: </b><span>#{{ $selectOrder->payment_status }}</span></p>
                    <p><b style="width: 140px;">Payment method: </b><span><small>{{ $selectOrder->payment_method }}</small></span></p>
                    <p><b style="width: 140px;">Transaction Id: </b><span>#{{ $selectOrder->transaction_id }}</span></p>
                    <p><b style="width: 140px;">date:</b> <span>{{ \Carbon\Carbon::create($selectOrder->created_at)->format('d.m.Y') }}</span></p>
                </div>
            </div>
            <div class="fp__invoice_body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <tr class="border_none">
                            <th class="sl_no">SL</th>
                            <th class="package">item description</th>
                            <th class="price">Price</th>
                            <th class="qnty">Quantity</th>
                            <th class="total">Total</th>
                        </tr>
                        @foreach($selectOrder->orderItems as $item)
                        <tr>
                            <td class="sl_no">01</td>
                            <td class="package">
                                <p>{{ $item->product_name }}</p>
                                <span class="size">{{ @json_decode($item->product_size)->name }}: {{ @json_decode($item->product_size)->price }} <small style="text-decoration: none;"></small></span>
                                @php $optSum = 0; @endphp
                                @foreach(json_decode($item->product_option) as $option)
                                    <span class="coca_cola">{{ $option->name }}: {{ $option->price }}</span>
                                    @php $optSum += $option->price @endphp
                                @endforeach
                            </td>
                            <td class="price">
                                <b>{{ $item->unit_price }} m.</b>
                            </td>
                            <td class="qnty">
                                <b>{{ $item->qty }}</b>
                            </td>
                            <td class="total">
                                <b>{{ $optSum + ($item->unit_price + @json_decode($item->product_size)->price) * $item->qty }} m.</b>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="package" colspan="3">
                                <b>sub total</b>
                            </td>
                            <td class="qnty">
                                <b>{{ $selectOrder->product_qty }}</b>
                            </td>
                            <td class="total">
                                <b>{{ $selectOrder->subtotal }} <small style="text-transform: lowercase;">m.</small></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="package coupon" colspan="3">
                                <b>(-) Discount coupon</b>
                            </td>
                            <td class="qnty">
                                <b></b>
                            </td>
                            <td class="total coupon">
                                <b>{{ $selectOrder->discount }} <small style="text-transform: lowercase;">m.</small></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="package coast" colspan="3">
                                <b>(+) Shipping Cost</b>
                            </td>
                            <td class="qnty">
                                <b></b>
                            </td>
                            <td class="total coast">
                                <b>{{ $selectOrder->delivery_charge }} <small style="text-transform: lowercase;">m.</small></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="package" colspan="3">
                                <b>Total Paid</b>
                            </td>
                            <td class="qnty">
                                <b></b>
                            </td>
                            <td class="total">
                                <b>{{ $selectOrder->grand_total }} <small style="text-transform: lowercase;">m.</small></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="package"  colspan="2">
                                <b>{{__('Amount in words')}}</b>
                            </td>
                            <td class="total" colspan="3">
                                <b style="font-family: 'Font Awesome 5 Free' !important;">{{ ucfirst(\App\Helpers\CalcCart::propis($selectOrder->grand_total)) }}</b>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>                
            </div>            
            
            <button type="button" id="action-print" class="print_btn common_btn"><i class="fas fa-print"></i> print
                PDF</button>

        </div>
            @script
            <script>
                document.getElementById('action-print').addEventListener('click', function() {
                    window.print();
                    return false;
                });
            </script>
            @endscript
    @endif
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
        .navbar{
            display: none;
        }
        .fp__topbar{
            display: none;
        }
        .fp__breadcrumb{
            display: none;
        }
        .fp__dashboard_menu{
            display: none;
        }
        .fp_dashboard_body h3{
            display: none;
        }
        .fp__track_order{
            display: none;
        }
        .go_back{
            display: none;
        }
        .fp__scroll_btn{
            display: none;
        }
        footer{
            display: none;
        }
        .fp__invoice .fp__invoice_header .invoice-print .container{
            margin: 0;
            padding: 0;
        }

    }
    </style>
</div>
