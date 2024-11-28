<section class="section">
    <div class="section-header">
        <h1>Settings</h1>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>All settings</h4>
                    <div class="card-header-action">
                        <a href="#" class="btn btn-primary" wire:navigate>
                            Create New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2">
                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#general" role="tab" aria-controls="home" aria-selected="true">General</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="tab-content no-padding" id="myTab2Content">
                                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="home-tab4">
                                    <div class="card border">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="site-name">{{__('Site Name')}}</label>
                                                <input name="site-name" type="text" class="form-control" wire:model="site_name">
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="currency">{{__('Currency Icon')}}</label>
                                                        <input name="currency" type="text" class="form-control" wire:model="currency_icon">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>{{__('Icon Position')}}</label>
                                                        <select class="form-control" wire:model="currency_icon_position">
                                                            <option value="right">{{__('Right')}}</option>
                                                            <option value="left">{{__('Left')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" wire:click="saveGeneral">{{__('Save')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                                    Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                                </div>
                                <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                    Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('tab-css')
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
@endpush

</section>
