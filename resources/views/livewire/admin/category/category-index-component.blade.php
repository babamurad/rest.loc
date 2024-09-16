@push('icon-css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-iconpicker.css') }}">
    <!-- Подключаем FontAwesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/FontAwesome.css') }}" />
    <style>
        .icon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(40px, 1fr));
            gap: 10px;
            max-width: 300px;
            margin-top: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
        }

        .icon-grid i {
            font-size: 24px;
            cursor: pointer;
            padding: 10px;
            border: 1px solid transparent;
        }

        .icon-grid i:hover {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
        }
    </style>
@endpush
@push('icon-js')
    <script src="{{ asset('admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="https://rest.loc/assets/js/Font-Awesome.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('iconPicker', () => ({
                open: false,
                icon: @entangle('icon'), // Связываем с Livewire
                icons: [
                    'fas fa-home', 'fas fa-user', 'fas fa-cog', 'fas fa-check', 'fas fa-times', 'fas fa-envelope',
                    'fas fa-phone', 'fas fa-heart', 'fas fa-percent', 'fas fa-receipt', 'fas fa-pizza-slice', 'fas fa-hamburger',
                    'fas fa-ice-cream', 'fas fa-carrot', 'fas fa-hat-chef', 'fas fa-burger-soda', 'fas fa-badge-percent', 'fas fa-badge-dollar',
                    'fas fa-soup', 'fas fa-pizza', 'fas fa-fish-cooked', 'fas fa-meat', 'fas fa-candy-corn', 'far fa-pie'
                ]
            }));
        });
    </script>

@endpush
<section class="section">
    <div class="section-header">
        <h1>{{ __('Why choose us section') }}</h1>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div x-data="{ open: false }" class="mb-4">
                <button x-on:click="open = ! open" class="btn btn-primary">Why Choose Us Titles</button>

                <div x-show="open" x-transition>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Top Title</label>
                                <input type="text" class="form-control @error('top_title') is-invalid @enderror" wire:model="top_title">
                                @error('top_title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Main Title</label> @error('title') is-invalid @enderror
                                <input type="text" class="form-control" wire:model="title">
                                @error('title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Sub Title</label>
                                <input type="text" class="form-control @error('sub_title') is-invalid @enderror" wire:model="sub_title">
                                @error('sub_title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary"  x-on:click="open = ! open" wire:click="saveTitle">Save</button>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div x-data="{ open: false }" class="mb-4">
                <button x-on:click="open = ! open" class="btn btn-primary">Daily Offer Titles</button>

                <div x-show="open" x-transition>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Top Title</label>
                                <input type="text" class="form-control @error('dtop_title') is-invalid @enderror" wire:model="dtop_title">
                                @error('dtop_title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Main Title</label> @error('dtitle') is-invalid @enderror
                                <input type="text" class="form-control" wire:model="dtitle">
                                @error('dtitle') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Sub Title</label>
                                <input type="text" class="form-control @error('dsub_title') is-invalid @enderror" wire:model="dsub_title">
                                @error('dsub_title') <div class="invalid-feedback">{{$message}}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary"  x-on:click="open = ! open" wire:click="saveDailyTitle">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Why choose us section items list') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                            Create New
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Status</th>
                            <th scope="col">Order</th>
                            <th scope="col" colspan="2" class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($categories)
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}">
                                            {{ ucfirst($category->name)  }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $category->slug  }}
                                    </td>
                                    <td>
                                        @if ($category->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>{{ $category->order }}</td>
                                    <td class="flex pr-0 m-0">
                                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-icon btn-primary">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    <td class="flex pl-0 m-0">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#ConfirmDelete" wire:click="deleteId({{ $category->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    @if(!$categories->isEmpty())
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

    <div wire:ignore.self class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="ConfirmDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ConfirmDelete">Удаление</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
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
