
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

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($dailyOffers)
                            @foreach ($dailyOffers as $dailyOffer)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <img src="{{ asset($dailyOffer->product->thumb_image) }}" alt="{{$dailyOffer->product->name}}" style="width: 48px;">
                                    </td>
                                    <td>
                                        {{ ucfirst($dailyOffer->product->name)  }}
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="agree{{ $dailyOffer->id }}" wire:click="ActInact({{ $dailyOffer->id }})"
                                                @if($dailyOffer->status) checked @endif>
                                                <label class="custom-control-label" for="agree{{ $dailyOffer->id }}" >
                                                @if ($dailyOffer->status)
                                                <span class="badge badge-success">Active</span>
                                                @else
                                                <span class="badge badge-danger">Inactive</span>
                                                @endif
                                                </label>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-left" style="width: 6%;">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ConfirmDelete" wire:click="getDelId({{ $dailyOffer->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $dailyOffers->links() }}
                    @if(!$dailyOffers)
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
