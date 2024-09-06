<section class="section">
    <div class="section-header">
        <h1>Profile</h1>

    @include('livewire.admin.components.alerts')


    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Update User Settings</h4>
                    </div>
                    <div class="card-body">
                        <form >
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" wire:model="email">
                            </div>
                            <button type="button" class="btn btn-primary" wire:click.prevent="updateUser">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Update Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" class="form-control" wire:model="current_password">
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" wire:model="password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" wire:model="password_confirmation">
                            </div>
                            <button type="button" class="btn btn-primary" wire:click="updatePassword">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

