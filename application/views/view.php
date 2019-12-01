<?php foreach ($user as $user): ?>

    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><?php echo $user->name; ?></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                    <div class="profile_img">
                        <div id="crop-avatar">
                            <!-- Current avatar -->
                            <?php if($user->photo){ ?>
                                <img class="img-responsive avatar-view" src="<?php echo base_url(); ?>assets/images/final/<?php echo $user->photo;?>" alt="Avatar">
                            <?php }else{ ?>
                                <img class="img-responsive avatar-view" src="<?php echo base_url(); ?>assets/images/user.png" alt="Avatar">
                            <?php } ?>
                        </div>
                    </div>
                    <br>
                    <h3><?php echo $user->name; ?></h3>
                    <br>

                    <ul class="list-unstyled user_data">
                        <li> <i class="material-icons user-profile-icon" title="Location">location_on</i> <?php echo $user->area; ?>, <?php echo $user->location; ?> </li>
                        <li> <i class="material-icons user-profile-icon" title="Status">check</i> <?php echo $user->status; ?> </li>
                        <li> <i class="material-icons user-profile-icon" title="Phone">phone</i> <?php echo $user->mobile; ?> </li>
                        <li> <i class="material-icons user-profile-icon" title="Email">email</i> <?php echo $user->email; ?> </li>
                        <?php if(package($user->package)){ ?>
                            <li> <i class="material-icons user-profile-icon" title="Current Package">view_list</i> <?php echo package($user->package)->packname . " (" . package($user->package)->packvolume . ") (" . package($user->package)->packprice . ") (" . package($user->package)->total . ")" ; ?> </li>
                            <li> <i class="material-icons user-profile-icon" title="Monthly Fee">attach_money</i> <?php echo settings()[0]->currency . " " . number_format((int)package($user->package)->packprice + package($user->package)->total, 2); ?> </li>
                        <?php }else{ ?>
                            <li> <i class="material-icons user-profile-icon" title="Current Package">view_list</i> N/A </li>
                            <li> <i class="material-icons user-profile-icon" title="Monthly Fee">attach_money</i> N/A </li>
                        <?php } ?>
                        <li> <i class="material-icons user-profile-icon" title="Service Start">date_range</i> <?php echo $user->join_date; ?> </li>

                    </ul>

                    <h3 class="title mt-20 mb-20">Connection Info</h3>
                    <ul class="list-unstyled user_data">
                        <li> <i class="material-icons user-profile-icon" title="Connection ID">dns</i> <?php echo $user->user_id; ?> </li>
                        <li> <i class="material-icons user-profile-icon" title="Connection Pass">fingerprint</i> <?php echo $user->password; ?> </li>
                        <?php if(!empty($user->pppoe_name)){ ?>
                            <li> <i class="material-icons user-profile-icon" title="PPPoE Name">account_circle</i> <?php echo $user->pppoe_name; ?> </li>
                            <li> <i class="material-icons user-profile-icon" title="PPPoE Password">fingerprint</i> <?php echo $user->pppoe_password; ?> </li>
                        <?php }?>
                        <?php if(!empty($user->hotspot_name)){ ?>
                            <li> <i class="material-icons user-profile-icon" title="Hotspot Name">account_circle</i> <?php echo $user->hotspot_name; ?> </li>
                            <li> <i class="material-icons user-profile-icon" title="Hotspot Password">fingerprint</i> <?php echo $user->hotspot_pass; ?> </li>
                        <?php } ?>
                    </ul>
                    <br>
                    <a class="btn btn-warning" href="<?php echo base_url(); ?>user/edit/<?php echo $user->id; ?>"><i class="fa fa-edit fa-fw m-right-xs"></i> Edit Profile</a>
                    <br />
                    <?php if(notAdmin()){ ?>
                        <a class="btn btn-warning" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit fa-fw m-right-xs"></i> Change Email</a>
                        <br>
                        <a <?php echo (!empty($user->pppoe_name)) ? "" : "disabled"; ?> class="btn btn-success" href="<?php echo base_url(); ?>pppoe/enable/<?php echo $user->pppoe_name; ?>"><i class="fa fa-check fa-fw m-right-xs"></i> Enable PPPoE</a>
                        <br />
                        <a <?php echo (!empty($user->pppoe_name)) ? "" : "disabled"; ?> class="btn btn-danger" href="<?php echo base_url(); ?>pppoe/disable/<?php echo $user->pppoe_name; ?>"><i class="fa fa-close fa-fw m-right-xs"></i> Disable PPPoE</a>
                        <br>
                        <a <?php echo (!empty($user->hotspot_name)) ? "" : "disabled"; ?> class="btn btn-success" href="<?php echo base_url();?>hotspot/enable/<?php echo $user->hotspot_name;?>"><i class="fa fa-check fa-fw m-right-xs"></i> Enable Hotspot</a>
                        <br />
                        <a <?php echo (!empty($user->hotspot_name)) ? "" : "disabled"; ?> class="btn btn-danger" href="<?php echo base_url();?>hotspot/disable/<?php echo $user->hotspot_name;?>"><i class="fa fa-close fa-fw m-right-xs"></i> Disable Hotspot</a>
                        <br>
                    <?php } ?>

                </div>
                <div class="col-md-9 col-sm-9 col-xs-12">.
                    <?php if($staff){ ?>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="material-icons">perm_identity</i> Your Line Man</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content ">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="well profile_view">
                                    <div class="col-sm-12">
                                        <div class="left col-xs-7">
                                            <h2><?php echo $staff->name;?></h2>
                                            <hr>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building fa-fw"></i> Area: <?php echo $staff->area;?> </li>
                                                <li><i class="fa fa-phone fa-fw"></i> Phone: <?php echo $staff->mobile;?> </li>
                                            </ul>
                                        </div>
                                        <div class="right col-xs-5 text-center">
                                            <?php if($staff->photo){ ?>
                                                <img src="<?php echo base_url(); ?>assets/images/final/<?php echo $staff->photo;?>" alt="" class="img-circle img-responsive">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url(); ?>assets/images/user.png" alt="" class="img-circle img-responsive">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="material-icons">show_chart</i> Reports</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content ">
                            <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>user/reports" accept-charset="utf-8">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Year</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" id="profileUserID" name="profileUserID" value="<?php echo $user->id; ?>">
                                        <select class="form-control" id="profileYearSelect" name="year">
                                            <option>Select Year</option>
                                            <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <hr>

                            <table class='table table-hover dtProfileReport'>
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Package</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="profileReport">
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Change Email</h4>
                          </div>
                          <div class="modal-body">
                              <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>user/changeemail" accept-charset="utf-8">
                                  <input id="id" name="id" value="<?php echo $user->id; ?>" type="hidden">
                                  <div class="item form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Email </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input class="form-control col-md-7 col-xs-12" name="email" value="<?php echo $user->email; ?>" type="email" placeholder="Enter Email For Login" >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-6 col-md-offset-3">
                                          <button id="send" type="Save Now!" class="btn btn-warning"><i class="material-icons">save</i> Change Now</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>


                </div> <!-- End of right side -->
            </div>
        </div>
    </div>
<?php endforeach; ?>

</div><!-- Container -->
