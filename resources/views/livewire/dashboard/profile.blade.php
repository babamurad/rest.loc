<div class="tab-pane fade" x-show="activeTab === 'home'"
     :class="activeTab === 'home' ? 'tab-pane fade active show' : 'tab-pane fade'"
>
    <div class="fp_dashboard_body">
        <h3>Welcome to your Profile</h3>

        <div class="fp__dsahboard_overview">
            <div class="row">
                <div class="col-xl-4 col-sm-6 col-md-4">
                    <div class="fp__dsahboard_overview_item">
                        <span class="icon"><i class="fas fa-shopping-basket"></i></span>
                        <h4>total order <span>(76)</span></h4>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-md-4">
                    <div class="fp__dsahboard_overview_item green">
                        <span class="icon"><i class="fas fa-shopping-basket"></i></span>
                        <h4>Completed <span>(71)</span></h4>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-md-4">
                    <div class="fp__dsahboard_overview_item red">
                        <span class="icon"><i class="fas fa-shopping-basket"></i></span>
                        <h4>cancel <span>(05)</span></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="fp_dash_personal_info">
            <h4>Parsonal Information
                <a class="dash_info_btn">
                    <span class="edit">edit</span>
                    <span class="cancel" wire:click="cancel">cancel</span>
                </a>
            </h4>

            <div class="personal_info_text">
                <p><span>Name:</span> {{ $name }}</p>
                <p><span>Email:</span> {{ $email }}</p>
                <p><span>Phone:</span> {{ $phone }}</p>
            </div>

            <div class="fp_dash_personal_info_edit comment_input p-0">
                <form wire:submit.prevent="updateUser">
                    <div class="row">
                        <div class="col-12">
                            <div class="fp__comment_imput_single">
                                <label>name</label>
                                <input type="text" name="name" placeholder="Name" wire:model="name">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="fp__comment_imput_single">
                                <label>email</label>
                                <input type="email" name="email" placeholder="Email" wire:model="email">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="fp__comment_imput_single">
                                <label>phone</label>
                                <input type="text" name="phone" placeholder="Phone" wire:model="phone">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="common_btn">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
