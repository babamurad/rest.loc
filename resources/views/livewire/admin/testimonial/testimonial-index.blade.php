
<section class="section">
    <div class="section-header">
        <h1>{{ __('Testimonials') }}</h1>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div x-data="{ open: @entangle('open') }" class="mb-4">
                <button x-on:click="open = ! open" class="btn btn-primary">{{ __('Testimonials Section Titles') }}</button>

                <div x-show="open" x-transition>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Top Title') }}</label>
                                <input type="text" class="form-control @error('top_title') is-invalid @enderror" wire:model="top_title">
                                @error('top_title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('Main Title') }}</label> @error('title') is-invalid @enderror
                                <input type="text" class="form-control" wire:model="title">
                                @error('title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Sub Title') }}</label>
                                <input type="text" class="form-control @error('sub_title') is-invalid @enderror" wire:model="sub_title">
                                @error('sub_title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" wire:click="saveTitle">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Testimonials list') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary">
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
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Show at home') }}</th>
                            <th scope="col" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($testimonials)
                            @foreach ($testimonials as $testimonial)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <a href="{{ route('admin.testimonial.edit', ['id' => $testimonial->id]) }}">
                                           <img class="rounded mb-1" src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->title }}" style="width: 92px;border: #c1c1c1 1px solid;"> 
                                        </a>                                        
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.testimonial.edit', ['id' => $testimonial->id]) }}">{{ $testimonial->name  }}</a>
                                    </td>
                                    <td>
                                        {{ ucfirst($testimonial->title)  }}
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="agree{{ $testimonial->id }}" wire:click="ActInact({{ $testimonial->id }})"
                                                @if($testimonial->status) checked @endif>
                                                <label class="custom-control-label" for="agree{{ $testimonial->id }}" >
                                                @if ($testimonial->status)
                                                <span class="badge badge-primary">{{ __('Active') }}</span>
                                                @else
                                                <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                                @endif
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="showAtHome{{ $testimonial->id }}" wire:click="showAtHome({{ $testimonial->id }})"
                                                @if($testimonial->show_at_home) checked @endif>
                                                <label class="custom-control-label" for="showAtHome{{ $testimonial->id }}" >
                                                @if ($testimonial->show_at_home)
                                                <span class="badge badge-primary">{{ __('Yes') }}</span>
                                                @else
                                                <span class="badge badge-danger">{{ __('No') }}</span>
                                                @endif
                                                </label>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center" style="width: 16%;">
                                        <a href="{{ route('admin.testimonial.edit', ['id' => $testimonial->id]) }}" class="btn btn-icon btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ConfirmDelete" wire:click="getDelId({{ $testimonial->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if(!$testimonials)
                        <p>{{ __('No items found.') }}</p>
                    @else
                        {{ $testimonials->links() }}
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
