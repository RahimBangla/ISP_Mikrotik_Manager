
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">person</i> Add New PPPoE User </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>pppoe/insert" accept-charset="utf-8">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Connect User <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="user" required>
                                <option value="">Select Portal User</option>
                                <?php foreach($users as $user){ ?>
                                    <option value="<?php echo $user->id;?>"><?php echo $user->name;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">PPPoE Username <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="name" type="text" placeholder="Enter PPPoE Username Here" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">PPPoE User Secret <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="password" type="password" placeholder="Enter PPPoE Secret Here" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Service <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="service" required>
                                <option value="">Select PPPoE Service</option>
                                <option value="any">Any</option>
                                <option value="async">Async</option>
                                <option value="l2tp">L2tp</option>
                                <option value="ovpn">Ovpn</option>
                                <option value="pptp">Pptp</option>
                                <option value="sstp">Sstp</option>
                                <option value="pppoe">PPPoE</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">PPPoE Profile <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="profile" required>
                                <option value="">Select PPPoE Profile</option>
                                <?php foreach($profiles as $profile){ ?>
                                    <option value="<?php echo $profile('name');?>"><?php echo $profile('name');?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">person_add</i> Add Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div><!-- Container -->
