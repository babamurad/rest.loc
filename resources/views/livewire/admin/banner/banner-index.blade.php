
<section class="section">
    <div class="section-header">
        <h1>{{ __('Banner Slider') }}</h1>        
    </div>    
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Banners List') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">
                            {{ __('Create New') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Image') }}</th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Sub Title') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($banners)
                            @foreach ($banners as $banner)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" style="width: 92px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.banner.edit', ['id' => $banner->id]) }}">{{ ucfirst($banner->title)  }}</a>                                        
                                    </td>
                                    <td>
                                        {{ ucfirst($banner->sub_title)  }}                                       
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="agree{{ $banner->id }}" wire:click="ActInact({{ $banner->id }})"
                                                @if($banner->status) checked @endif>
                                                <label class="custom-control-label" for="agree{{ $banner->id }}" >
                                                @if ($banner->status)
                                                <span class="badge badge-success">{{ __('Active') }}</span>
                                                @else
                                                <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                @endif
                                                </label>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center" style="width: 16%;">
                                        <a href="{{ route('admin.banner.edit', ['id' => $banner->id]) }}" class="btn btn-icon btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ConfirmDelete" wire:click="getDelId({{ $banner->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    
                    @if(!$banners)
                        <p>{{ __('No items found.') }}</p>
                    @else
                        {{ $banners->links() }}
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
                    <h5 class="modal-title">{{ __('Удаление') }}</h5>
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
