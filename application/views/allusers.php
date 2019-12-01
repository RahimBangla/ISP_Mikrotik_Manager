
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <a class="btn btn-primary right" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus fa-fw m-right-xs"></i> Add User</a>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">group</i> All Users

                </h2>
                <div class="clearfix"></div>

            </div>
            <div class="x_content">
                <table class="dtAllUsers table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">No </th>
                            <th class="column-title" style="display: table-cell;">Photo </th>
                            <th class="column-title" style="display: table-cell;">Name </th>
                            <th class="column-title" style="display: table-cell;">Mobile </th>
                            <th class="column-title" style="display: table-cell;">Package </th>
                            <th class="column-title" style="display: table-cell;">ID </th>
                            <th class="column-title" style="display: table-cell;">Password </th>
                            <th class="column-title" style="display: table-cell;">Status </th>
                            <th class="column-title" style="display: table-cell;">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($users as $row) { $i++; ?>

                            <tr class="even pointer">
                                <td class=" "><?php echo $i; ?></td>
                                <?php if($row->photo){?>
                                    <td class=" "><img class="userPhoto" src="<?php echo base_url() . "assets/images/final/" . $row->photo; ?>" alt="Photo"></td>
                                <?php } else{ ?>
                                    <td class=" "><img class="userPhoto" src="<?php echo base_url()?>assets/images/user.png" alt="Photo"></td>
                                <?php } ?>
                                <td class=" "><?php echo $row->name; ?></td>
                                <td class=" "><?php echo $row->mobile; ?></td>

                                <?php if(package($row->package)){ ?>
                                    <td class=" "><span class="label label-primary"><?php echo package($row->package)->packname . " (" . package($row->package)->packvolume . ") (" . package($row->package)->packprice . ") (" . package($row->package)->total . ")" ; ?></span></td>
                                <?php }else{ ?>
                                    <td class=" ">N/A</td>
                                <?php } ?>

                                <td class=" "><?php echo $row->user_id; ?></td>
                                <td class=" "><?php echo $row->password; ?></td>
                                <td class=""><span class="label label-<?php
                                    if ($row->status == "Active") {
                                        echo "success";
                                    } elseif ($row->status == "Pending") {
                                        echo "primary";
                                    } else {
                                        echo "warning";
                                    }
                                    ?>"><?php echo $row->status; ?></span></td>
                                <td class="action-link">
                                    <a href="<?php echo base_url(); ?>user/view/<?php echo $row->id; ?>/"><span class="label label-success">View</span></a>
                                    <a href="<?php echo base_url(); ?>user/edit/<?php echo $row->id; ?>/" ><span class="label label-warning">Edit</span></a>
                                    <a href="<?php echo base_url(); ?>user/delete/<?php echo $row->id; ?>/" ><span class="label label-danger delete">Delete</span></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New User</h4>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>user/insert" accept-charset="utf-8">
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Photo</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" name="photo" type="file">
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Name <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" id="name" name="name" type="text" placeholder="Enter Name Here" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Mobile <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" id="mobile" name="mobile" type="text" placeholder="Enter Mobile Number" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Package <span class="required">*</span></label>
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
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Area <span class="required">*</span></label>
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
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Line Man/Staff <span class="required">*</span></label>
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
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Connection ID <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" id="user_id" name="user_id" type="text" placeholder="Enter ID" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Connection Pass <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" id="password" name="password" type="text" placeholder="Enter Password" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Join Date <span class="required">*</span></label>
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
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Role <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control" id="status" name="role" required>
                                  <option value="">Select Role</option>
                                  <option value="Admin">Admin</option>
                                  <option value="User">User</option>
                              </select>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Account Email <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" name="email" type="email" placeholder="Enter Email For Login" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Account Password <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" name="accpass" type="password" placeholder="Enter Password For Login" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-1">Location <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" id="location" name="location" type="text" placeholder="Enter Location" required="required">
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">Add Now</button>
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


    </div>
    </div><!-- Container -->
