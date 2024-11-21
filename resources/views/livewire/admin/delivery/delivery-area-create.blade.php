<section class="section">
    <div class="section-header">
        <h1>Create Delivery Area</h1>
        @include('livewire.admin.components.alerts')
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{__('Create Delivery Area')}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" class="form-control @error('area_name') is-invalid @enderror" wire:model="area_name">
                                @error('area_name') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>{{__('Min delivery time')}}</label>
                                <input type="number" class="form-control @error('min_delivery_time') is-invalid @enderror" wire:model="min_delivery_time">
                                @error('min_delivery_time') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>{{__('Max delivery time')}}</label>
                                <input type="number" class="form-control @error('max_delivery_time') is-invalid @enderror" wire:model="max_delivery_time">
                                @error('max_delivery_time') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>{{__('Delivery Fee')}}</label>
                                <input type="number" class="form-control @error('delivery_fee') is-invalid @enderror" wire:model="delivery_fee">
                                @error('delivery_fee') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>{{__('Status')}}</label>
                                <select class="form-control @error('status') is-invalid @enderror"  wire:model="status">
                                    <option value="1" selected>{{__('Active')}}</option>
                                    <option value="0">{{__('Inactive')}}</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-left">
                    <button class="btn btn-primary mr-1" type="submit" wire:click.prevent="create">Submit</button>
                    <button class="btn btn-secondary" type="reset" wire:click="cancel">Cancel</button>
                </div>

            </div>
        </div>
    </div>
</section>

