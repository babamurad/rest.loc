<section class="section">
    <div class="section-header">
        <h1>Coupon</h1>
        @include('livewire.admin.components.alerts')
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Create Coupon</h4>
                    {{--                     wire:keyup="generateSlug()"--}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                                @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{__('Coupon Code')}}</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" wire:model="code">
                                @error('code') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{__('Status')}}</label>
                                <select class="form-control @error('link') is-invalid @enderror"  wire:model="status">
                                    <option value="1">{{__('Yes')}}</option>
                                    <option value="0">{{__('No')}}</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{__('Quantity')}}</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" wire:model="quantity">
                                @error('quantity') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{__('Minimum Purchase Price')}}</label>
                                <input type="number" class="form-control @error('min_purchase_amount') is-invalid @enderror" wire:model="min_purchase_amount">
                                @error('min_purchase_amount') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{__('Expire Date')}}</label>
                                <input type="date" class="form-control @error('expire_date') is-invalid @enderror" wire:model="expire_date">
                                @error('expire_date') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{__('Discount type')}}</label>
                                <select class="form-control @error('discount_type') is-invalid @enderror"  wire:model="discount_type">
                                    <option value="percent">{{__('Percent')}}</option>
                                    <option value="amount">{{__('Amount')}}</option>
                                </select>
                                @error('discount_type') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                <label>{{__('Discount Amount')}}</label>
                                <input type="number" class="form-control @error('discount') is-invalid @enderror" wire:model="discount">
                                @error('discount') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="update">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</section>

