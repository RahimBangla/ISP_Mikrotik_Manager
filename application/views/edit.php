
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <?php foreach ($edit_user as $row) ?>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">person</i> Edit User | <?php echo $row->name; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>user/update" accept-charset="utf-8">
                    <input id="id" name="id" value="<?php echo $row->id; ?>" type="hidden">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="photo" type="file">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="name" name="name" value="<?php echo $row->name; ?>" type="text" placeholder="Enter Name Here" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="mobile" name="mobile" value="<?php echo $row->mobile; ?>" type="text" placeholder="Enter Mobile Nummber" required>
                        </div>
                    </div>
                    <?php if(notAdmin()){?>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Package <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="package" name="package" required>
                                <option value="">Select Package</option>
                                <?php if(package($row->package) !=false ){ ?>
                                    <option selected value="<?php echo package($row->package)->packid; ?>"><?php echo package($row->package)->packname; ?> (Current)</option>
                                <?php } ?>
                                <?php foreach ($packages as $pack) { ?>
                                    <option value="<?php echo $pack->packid; ?>"><?php echo $pack->packname; ?> (<?php echo $pack->packvolume; ?>) (<?php echo $pack->packprice; ?>) <?php if($pack->total){ echo "(" . $pack->total . ")"; } ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Area <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="package" name="area" required>
                                <option value="">Select Area</option>
                                <option selected value="<?php echo $row->area; ?>"><?php echo $row->area; ?> (Current)</option>
                                <?php foreach ($area as $area) {?>
                                    <option value="<?php echo $area->name;?>"><?php echo $area->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Line Man/Staff <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="package" name="staff" required>
                                <option value="">Select Line Man/Staff</option>
                                <?php if(staffByID($row->staff) !=false ){ ?>
                                    <option selected value="<?php echo $row->staff; ?>"><?php echo staffByID($row->staff)->name; ?> (Current)</option>
                                <?php } ?>
                                <?php foreach ($staff as $staff) {?>
                                    <option value="<?php echo $staff->id;?>"><?php echo $staff->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
<!--                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="amount" name="amount" value="<?php echo $row->amount; ?>" type="text" placeholder="Enter Amount" required>
                        </div>
                    </div>-->
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Connection ID <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="user_id" name="user_id" value="<?php echo $row->user_id; ?>" type="text" placeholder="Enter ID" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Connection Pass <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="password" name="password" value="<?php echo $row->password; ?>" type="text" placeholder="Leave blank to use old password" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Join Date <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="join_date" name="join_date" value="<?php echo $row->join_date; ?>" type="date" placeholder="Enter Join Date" required>
                        </div>
                    </div>
<!--                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Advance <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="advance" name="advance" value="<?php echo $row->advance; ?>" type="text" placeholder="Enter Advance Payment" required>
                        </div>
                    </div>-->
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="status" name="role" required>
                                <option value="">Select Role</option>
                                <option selected value="<?php echo $row->role;?>"><?php echo $row->role;?></option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option selected value="<?php echo $row->status;?>"><?php echo $row->status;?></option>
                                <option value="Active">Active</option>
                                <option value="Deactive">Inactive</option>
                                <option value="Warning">Warning</option>
                                <option value="Pending">Pending</option>
                                <option value="Unpaid">Unpaid</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                    </div>
                    <?php } ?>


                    <!-- <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Email </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="email" value="<?php echo $row->email; ?>" type="email" placeholder="Enter Email For Login" >
                        </div>
                    </div> -->

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Password </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="email" name="accpass" type="password" placeholder="Enter Password For Login" >
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Location </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="location" name="location" value="<?php echo $row->location; ?>" type="text" placeholder="Enter Location" required="required">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">save</i> Update Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div><!-- Container -->
