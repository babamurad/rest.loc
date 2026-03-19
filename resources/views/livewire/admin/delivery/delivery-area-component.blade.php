
<section class="section">
    <div class="section-header">
        <h1>{{ __('Delivery Area') }}</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Delivery Area') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.delivery-area.create') }}" class="btn btn-primary">
                            {{__('Create New')}}
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Min/Max') }}</th>
                            <th scope="col">{{ __('Delivery') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($areas)
                            @foreach ($areas as $area)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <a href="{{ route('admin.delivery-area.edit', ['id' => $area->id]) }}" class="badge badge-primary">{{ ucfirst($area->area_name)  }}</a>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">{{ $area->min_delivery_time  }} - {{ $area->max_delivery_time  }} {{__('minute')}}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $area->delivery_fee  }} {{ __('manat') }}</span>
                                    </td>
                                    <td>
                                        @if ($area->status)
                                            <span class="badge badge-success">{{ __('Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width: 10%;">
                                        <a href="{{ route('admin.delivery-area.edit', ['id' => $area->id]) }}" class="btn btn-icon btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ConfirmDelete" wire:click="deleteId({{ $area->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $areas->links() }}
                    @if(!$areas)
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
    </script>

    <!-- Modal -->

    <div wire:ignore class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="ConfirmDelete" aria-hidden="true" style="background-color: rgb(70 70 70 / 50%);">
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
