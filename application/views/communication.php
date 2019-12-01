
<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">sms</i> Email</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="container">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#quickEmail" aria-controls="quickEmail" role="tab" data-toggle="tab">Quick Email</a></li>
                        <li role="presentation"><a href="#userID" aria-controls="home" role="tab" data-toggle="tab">Email By UserID</a></li>
                        <li role="presentation"><a href="#package" aria-controls="profile" role="tab" data-toggle="tab">Email By Package</a></li>
                        <li role="presentation"><a href="#area" aria-controls="profile" role="tab" data-toggle="tab">Email By Area</a></li>
                        <li role="presentation"><a href="#admin" aria-controls="profile" role="tab" data-toggle="tab">Email By Staff</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="quickEmail">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/quickemail" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Emails <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="emails" class="form-control col-md-7 col-xs-12" placeholder="Single/Multiple Email, Separate By Comma " required="">

                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Subject <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="subject" class="form-control col-md-7 col-xs-12" placeholder="Email Subject" required="">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Email Message <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div role="tabpanel" class="tab-pane" id="userID">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/emailbyuser" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">User <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12"  name="userid" required="">
                                            <option value="">Select Username</option>
                                            <?php foreach($users as $user){ ?>
                                                <option value="<?php echo $user->id;?>"><?php echo $user->name;?> (<?php echo $user->user_id;?>) (<?php echo $user->email;?>)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Subject <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="subject" class="form-control col-md-7 col-xs-12" placeholder="Email Subject" required="">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Message <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>


                        <div role="tabpanel" class="tab-pane" id="package">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/emailbypackage" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Package <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12"  name="package" required="">
                                            <option value="">Select Package</option>
                                            <?php foreach($packages as $package){ ?>
                                                <option value="<?php echo $package->packid;?>"><?php echo $package->packname;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Subject <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="subject" class="form-control col-md-7 col-xs-12" placeholder="Email Subject" required="">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Message <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="area">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/emailbyarea" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Area <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12"  name="area" required="">
                                            <option value="">Select Area</option>
                                            <?php foreach($areas as $area){ ?>
                                                <option value="<?php echo $area->name;?>"><?php echo $area->name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Subject <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="subject" class="form-control col-md-7 col-xs-12" placeholder="Email Subject" required="">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Message <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="admin">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/emailbystaff" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Staff <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12"  name="staff" required="">
                                            <option value="">Select Staff</option>
                                            <?php foreach($staffs as $staff){ ?>
                                                <option value="<?php echo $staff->id;?>"><?php echo $staff->name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Subject <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="subject" class="form-control col-md-7 col-xs-12" placeholder="Email Subject" required="">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Message <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">sms</i> SMS</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="container">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#quickEmailSMS" aria-controls="quickEmailSMS" role="tab" data-toggle="tab">Quick SMS</a></li>
                        <li role="presentation"><a href="#userIDSMS" aria-controls="home" role="tab" data-toggle="tab">SMS By UserID</a></li>
                        <li role="presentation"><a href="#packageSMS" aria-controls="profile" role="tab" data-toggle="tab">SMS By Package</a></li>
                        <li role="presentation"><a href="#areaSMS" aria-controls="profile" role="tab" data-toggle="tab">SMS By Area</a></li>
                        <li role="presentation"><a href="#adminSMS" aria-controls="profile" role="tab" data-toggle="tab">SMS By Staff</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="quickEmailSMS">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/quicksms" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Mobile Numbers <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="numbers" class="form-control col-md-7 col-xs-12" placeholder="Single/Multiple Numbers, Separate By Comma " required="">

                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">SMS Text <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea maxlength="160" class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <div role="tabpanel" class="tab-pane" id="userIDSMS">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/smsbyuser" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">User <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12"  name="userid" required="">
                                            <option value="">Select Username</option>
                                            <?php foreach($users as $user){ ?>
                                                <option value="<?php echo $user->id;?>"><?php echo $user->name;?> (<?php echo $user->user_id;?>) (<?php echo $user->mobile;?>)</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">SMS Text <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea maxlength="160" class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>


                        <div role="tabpanel" class="tab-pane" id="packageSMS">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/smsbypackage" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Package <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12"  name="package" required="">
                                            <option value="">Select Package</option>
                                            <?php foreach($packages as $package){ ?>
                                                <option value="<?php echo $package->packid;?>"><?php echo $package->packname;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">SMS Text <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea maxlength="160" class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="areaSMS">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/smsbyarea" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Area <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12"  name="area" required="">
                                            <option value="">Select Area</option>
                                            <?php foreach($areas as $area){ ?>
                                                <option value="<?php echo $area->name;?>"><?php echo $area->name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">SMS Text <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  maxlength="160" class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="adminSMS">

                            <form class="form-horizontal form-label-left smallSpaceTop" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>communication/smsbystaff" accept-charset="utf-8">

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Staff <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control col-md-7 col-xs-12"  name="staff" required="">
                                            <option value="">Select Staff</option>
                                            <?php foreach($staffs as $staff){ ?>
                                                <option value="<?php echo $staff->id;?>"><?php echo $staff->name;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12">SMS Text <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  maxlength="160" class="form-control col-md-7 col-xs-12" name="message" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">chat</i> Send Now</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- Container -->
