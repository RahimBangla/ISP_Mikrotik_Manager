
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">person</i> New User</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>user/insert" accept-charset="utf-8">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="photo" type="file">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="name" name="name" type="text" placeholder="Enter Name Here" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="mobile" name="mobile" type="text" placeholder="Enter Mobile Number" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Package <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="package" name="package" required>
                                <option>Select Package</option>
                                <?php foreach ($packages as $row) {?>
                                    <option value="<?php echo $row->packid;?>"><?php echo $row->packname;?> (<?php echo $row->packvolume;?>) (<?php echo $row->packprice;?>) <?php if($row->total){ echo "(" . $row->total . ")"; } ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Area <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="package" name="area" required>
                                <option>Select Area</option>
                                <?php foreach ($area as $row) {?>
                                    <option value="<?php echo $row->name;?>"><?php echo $row->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Line Man/Staff <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="package" name="staff" required>
                                <option>Select Line Man/Staff</option>
                                <?php foreach ($staff as $row) {?>
                                    <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
<!--                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fee Amount<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="amount" name="amount" type="text" placeholder="Enter Monthly Fee Amount" required>
                        </div>
                    </div>-->
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Connection ID <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="user_id" name="user_id" type="text" placeholder="Enter ID" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Connection Pass <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="password" name="password" type="text" placeholder="Enter Password" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Join Date <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="join_date" name="join_date" type="date" placeholder="Enter Join Date" required>
                        </div>
                    </div>
<!--                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Service Charge <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="advance" name="advance" type="text" placeholder="Enter Advance Payment/Service Charge" required>
                        </div>
                    </div>-->
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="status" name="role" required>
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Email <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="email" type="email" placeholder="Enter Email For Login" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="accpass" type="password" placeholder="Enter Password For Login" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Location <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="location" name="location" type="text" placeholder="Enter Location" required="required">
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
