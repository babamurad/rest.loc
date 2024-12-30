
<section class="section">
    <div class="section-header">
        <h1>{{ __('Daily Offers') }}</h1>
        {{--        @include('livewire.admin.components.alerts')--}}
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Daily Offers list') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.daily-offer.create') }}" class="btn btn-primary">
                            Create New
                        </a>
                    </div>
                </div>
                <div class="card-body">

{{--                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Discount Type</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Expired Date</th>
                            <th scope="col" class="text-center" colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($coupons)
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <a href="{{ route('admin.coupon.edit', ['id' => $coupon->id]) }}">
                                            {{ ucfirst($coupon->name)  }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ $coupon->code  }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ $coupon->quantity  }}</span>
                                    </td>
                                    <td>
                                        @if ($coupon->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coupon->discount_type == 'percent')
                                            <span class="badge text-white" style="background-color: #32a1d3;">%</span>
                                        @else
                                            <span class="badge badge-info">$</span>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-secondary">{{ $coupon->discount }}</span></td>
                                    <td><span class="badge badge-light">{{ \Carbon\Carbon::create($coupon->expire_date)->format('d.m.Y') }}</span></td>
                                    <td class="text-center" style="width: 10%;">
                                        <a href="{{ route('admin.coupon.edit', ['id' => $coupon->id]) }}" class="btn btn-icon btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="text-left" style="width: 6%;">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ConfirmDelete" wire:click="getDelId({{ $coupon->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $coupons->links() }}
                    @if(!$coupons)
                        <p>No items found.</p>
                    @endif--}}
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
    <div wire:ignore class="modal fade mt-5" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="ConfirmDelete" aria-hidden="true" style="background-color: rgb(70 70 70 / 50%);">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Удаление</h5>
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
