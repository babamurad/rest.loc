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
                        @if($chooses)
                            @foreach ($chooses as $choose)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td style="width: 20%;">
                                        <a href="{{ route('admin.slider.edit', ['id' => $choose->id]) }}">
                                            <img class="img-fluid w-25 rounded" src="{{ asset($slider->image) }}" alt="">
                                        </a>
                                    </td>
                                    <td><a href="{{ route('admin.slider.edit', ['id' => $choose->id]) }}">{{ $choose->title }}</a> </td>
                                    <td>{{ $choose->offer }}</td>
                                    <td>
                                        @if ($choose->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="flex pr-0 m-0">
                                        <a href="{{ route('admin.slider.edit', ['id' => $choose->id]) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                    </td>
                                    <td class="flex pl-0 m-0">
                                        <div x-data="{ showModal: false }">
                                            <a wire:click="deleteSlide({{ $choose->id }})" @click="showModal = true"  href="#" class="btn btn-icon btn-danger"><i
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
                        @endif
                        </tbody>
                    </table>
                    @if(!$chooses)
                        <p>No items found.</p>
                    @endif
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
</section>
