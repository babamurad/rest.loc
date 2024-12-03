<div class="tab-pane fade"  x-show="activeTab === 'order-list'"
     :class="activeTab === 'order-list' ? 'tab-pane fade active show' : 'tab-pane fade'"
>
{{--     x-data="{viewOrder: @entangle('viewOrder')}"--}}
    <div class="fp_dashboard_body">
        <h3>order list</h3>

        @if(!$selectOrder)

        <div class="fp_dashboard_order">
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
                        <td><a class="view_invoice" wire:click="invoice({{ $order->id }})">View Details</a></td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        @elseif($selectOrder)

        <div class="fp__invoice">
            <a class="go_back"><i class="fas fa-long-arrow-alt-left"></i> go back</a>
            <div class="fp__track_order">
                <ul>
                    <li class="active">order pending</li>
                    <li>order accept</li>
                    <li>order process</li>
                    <li>on the way</li>
                    <li>Completed</li>
                </ul>
            </div>
            <div class="fp__invoice_header">
                <div class="header_address">
                    <h4>invoice to</h4>
                    <p>{{ $selectOrder->address->address }}</p>
                    <p>{{ $selectOrder->address->phone }}</p>
                </div>
                <div class="header_address">
                    <p><b>invoice no: </b><span>4574</span></p>
                    <p><b>Order ID:</b> <span> #{{ $selectOrder->invoice_id }}</span></p>
                    <p><b>date:</b> <span>{{ \Carbon\Carbon::create($selectOrder->created_at)->format('d.m.Y') }}</span></p>
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
                        <tr>
                            <td class="sl_no">01</td>
                            <td class="package">
                                <p>Hyderabadi Biryani</p>
                                <span class="size">small</span>
                                <span class="coca_cola">coca-cola</span>
                                <span class="coca_cola2">7up</span>
                            </td>
                            <td class="price">
                                <b>$120</b>
                            </td>
                            <td class="qnty">
                                <b>2</b>
                            </td>
                            <td class="total">
                                <b>$240</b>
                            </td>
                        </tr>
                        <tr>
                            <td class="sl_no">02</td>
                            <td class="package">
                                <p>Daria Shevtsova</p>
                                <span class="size">medium</span>
                                <span class="coca_cola">coca-cola</span>
                            </td>
                            <td class="price">
                                <b>$120</b>
                            </td>
                            <td class="qnty">
                                <b>2</b>
                            </td>
                            <td class="total">
                                <b>$240</b>
                            </td>
                        </tr>
                        <tr>
                            <td class="sl_no">03</td>
                            <td class="package">
                                <p>Hyderabadi Biryani</p>
                                <span class="size">large</span>
                                <span class="coca_cola2">7up</span>
                            </td>
                            <td class="price">
                                <b>$120</b>
                            </td>
                            <td class="qnty">
                                <b>2</b>
                            </td>
                            <td class="total">
                                <b>$240</b>
                            </td>
                        </tr>
                        <tr>
                            <td class="sl_no">04</td>
                            <td class="package">
                                <p>Hyderabadi Biryani</p>
                                <span class="size">medium</span>
                                <span class="coca_cola">coca-cola</span>
                                <span class="coca_cola2">7up</span>
                            </td>
                            <td class="price">
                                <b>$120</b>
                            </td>
                            <td class="qnty">
                                <b>2</b>
                            </td>
                            <td class="total">
                                <b>$240</b>
                            </td>
                        </tr>
                        <tr>
                            <td class="sl_no">05</td>
                            <td class="package">
                                <p>Daria Shevtsova</p>
                                <span class="size">large</span>
                            </td>
                            <td class="price">
                                <b>$120</b>
                            </td>
                            <td class="qnty">
                                <b>2</b>
                            </td>
                            <td class="total">
                                <b>$240</b>
                            </td>
                        </tr>
                        <tr>
                            <td class="sl_no">04</td>
                            <td class="package">
                                <p>Hyderabadi Biryani</p>
                                <span class="size">medium</span>
                                <span class="coca_cola">coca-cola</span>
                                <span class="coca_cola2">7up</span>
                            </td>
                            <td class="price">
                                <b>$120</b>
                            </td>
                            <td class="qnty">
                                <b>2</b>
                            </td>
                            <td class="total">
                                <b>$240</b>
                            </td>
                        </tr>
                        <tr>
                            <td class="sl_no">04</td>
                            <td class="package">
                                <p>Hyderabadi Biryani</p>
                                <span class="size">medium</span>
                                <span class="coca_cola">coca-cola</span>
                                <span class="coca_cola2">7up</span>
                            </td>
                            <td class="price">
                                <b>$120</b>
                            </td>
                            <td class="qnty">
                                <b>2</b>
                            </td>
                            <td class="total">
                                <b>$240</b>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="package" colspan="3">
                                <b>sub total</b>
                            </td>
                            <td class="qnty">
                                <b>12</b>
                            </td>
                            <td class="total">
                                <b>$755</b>
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
                                <b>$0.00</b>
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
                                <b>$10.00</b>
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
                                <b>$765</b>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <a class="print_btn common_btn" href="#"><i class="far fa-print"></i> print
                PDF</a>

        </div>
        @endif
    </div>
</div>
