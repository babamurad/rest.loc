<section class="section">
    <div class="section-header">
        <h1>Slider</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Card Header</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.slider.create') }}" class="btn btn-primary" wire:navigate>
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
                                <th scope="col">Title</th>
                                <th scope="col">Offer</th>
                                <th scope="col">Status</th>
                                <th scope="col" colspan="2" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($sliders)
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td style="width: 20%;">
                                            <a href="{{ route('admin.slider.edit', ['id' => $slider->id]) }}">
                                                <img class="img-fluid w-25 rounded" src="{{ asset($slider->image) }}" alt="">
                                            </a>
                                        </td>
                                        <td><a href="{{ route('admin.slider.edit', ['id' => $slider->id]) }}">{{ $slider->title }}</a> </td>
                                        <td>{{ $slider->offer }}</td>
                                        <td>
                                            @if ($slider->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="flex pr-0 m-0">
                                            <a href="{{ route('admin.slider.edit', ['id' => $slider->id]) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                        </td>
                                        <td class="flex pl-0 m-0">
                                            <div x-data="{ showModal: false }">
                                                <a wire:click="deleteSlide({{ $slider->id }})" @click="showModal = true"  href="#" class="btn btn-icon btn-danger"><i
                                                        class="fas fa-trash"></i></a>
                                                <!-- Модальное окно -->
                                                <div x-show="showModal"
                                                     x-transition:enter="transition ease-out duration-300"
                                                     x-transition:enter-start="opacity-0 scale-90"
                                                     x-transition:enter-end="opacity-100 scale-100"
                                                     x-transition:leave="transition ease-in duration-300"
                                                     x-transition:leave-start="opacity-100 scale-100"
                                                     x-transition:leave-end="opacity-0 scale-90"
                                                     class="modal" style="display: none;">
                                                    <div class="modal-content">
                                                        <h2>Подтверждение удаления</h2>
                                                        <p>Вы уверены, что хотите удалить этот элемент?</p>

                                                        <!-- Кнопки подтверждения и отмены -->
                                                        <button wire:click="destroy" @click="showModal = false" class="btn btn-danger">
                                                            Подтвердить удаление
                                                        </button>
                                                        <button @click="showModal = false" class="btn btn-secondary">
                                                            Отмена
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <p>No items found</p>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Скрипты для модального окна -->
     <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            text-align: center;
        }
    </style>

    {{--<script>
        window.addEventListener('closeModal', event => {
            $('#ConfirmDelete').modal('hide');
        })
    </script>

    <!-- Modal -->

    <div wire:ignore.self class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog"
        aria-labelledby="ConfirmDelete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ConfirmDelete">Öçürmek</h5>
                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bu ýazgyny dogrudanam öçürjekmi?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light"
                        data-dismiss="modal">Goýbolsun</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light"
                        wire:click="destroy">Öçür</button>
                </div>
            </div>
        </div>
    </div>--}}
</section>
