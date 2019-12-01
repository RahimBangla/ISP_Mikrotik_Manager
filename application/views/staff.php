
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">perm_identity</i> Staff</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>staff/insert" accept-charset="utf-8">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="photo" type="file">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="name" type="text" placeholder="Staff/Line Man Name" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="mobile" type="text" placeholder="Staff Contact" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Staff's Area <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="area">
                                <?php foreach ($area as $row) { ?>													 
                                    <option value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>  
                                <?php } ?>
                            </select> 
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">                                                
                            <button id="send" type="submit" class="btn btn-success"><i class="material-icons">add</i> Add Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="x_panel">
            <div class="x_title"> 
                <h2><i class="material-icons">perm_identity</i> All Staffs</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="dtPackages table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">                                             
                            <th class="column-title" style="display: table-cell;">No </th>
                            <th class="column-title" style="display: table-cell;">Photo </th>
                            <th class="column-title" style="display: table-cell;">Name </th>
                            <th class="column-title" style="display: table-cell;">Area </th>
                            <th class="column-title" style="display: table-cell;">Contact </th>                            
                            <th class="column-title" style="display: table-cell;">Users </th>
                            <th class="column-title" style="display: table-cell;">Active Users</th>
                            <th class="column-title" style="display: table-cell;">Pending/Deactive Users</th>
                            <th class="column-title" style="display: table-cell;">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($staff as $row) { $i++; ?>
                            <tr class="eventpointer">
                                <td class=" "><?php echo $i; ?></td>
                                <?php if($row->photo){?>
                                    <td class=" "><img class="userPhoto" src="<?php echo base_url() . "assets/images/final/" . $row->photo; ?>" alt="Photo"></td>
                                <?php } else{ ?>
                                    <td class=" "><img class="userPhoto" src="<?php echo base_url()?>assets/images/user.png" alt="Photo"></td>
                                <?php } ?>    
                                <td class=" "><?php echo $row->name; ?></td>
                                <td class=" "><?php echo $row->area; ?></td>
                                <td class=" "><?php echo $row->mobile; ?></td>                                
                                <td class=" "><?php echo countRow('users', 'staff', $row->id); ?></td>
                                <td class=" "><?php echo countRow2('users', 'staff', $row->id, 'status', 'Active'); ?></td>
                                <td class=" "><?php echo countRow('users', 'staff', $row->id) - countRow2('users', 'staff', $row->id, 'status', 'Active'); ?></td>
                                <td class="action-link">
                                    <a href="<?php echo base_url(); ?>staff/edit/<?php echo $row->id; ?>"><span class="label label-warning">Edit</span></a>
                                    <a href="<?php echo base_url(); ?>staff/delete/<?php echo $row->id; ?>"><span class="label label-danger delete">Delete</span></a>
                                </td>	
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div><!-- Container -->