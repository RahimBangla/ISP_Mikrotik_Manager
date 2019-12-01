
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">my_location</i> Update Area</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php foreach ($singleArea as $row) : ?>     

                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>area/update" accept-charset="utf-8">
                    <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="name" type="text" placeholder="Area Name" value="<?php echo $row->name; ?>" required>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">                                                
                            <button id="send" type="submit" class="btn btn-success"><i class="material-icons">add</i> Update Now</button>
                        </div>
                    </div>
                </form>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="x_panel">
            <div class="x_title"> 
                <h2><i class="material-icons">view_list</i> All Areas</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="dtPackages table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">                                             
                            <th class="column-title" style="display: table-cell;">No </th>
                            <th class="column-title" style="display: table-cell;">Name </th>
                            <th class="column-title" style="display: table-cell;">Users </th>
                            <th class="column-title" style="display: table-cell;">Active Users</th>
                            <th class="column-title" style="display: table-cell;">Pending/Deactive Users</th>
                            <th class="column-title" style="display: table-cell;">Line Mans </th>
                            <th class="column-title" style="display: table-cell;">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($area as $row) { $i++; ?>
                            <tr class="eventpointer">
                                <td class=" "><?php echo $i; ?></td>
                                <td class=" "><?php echo $row->name; ?></td>
                                <td class=" "><?php echo countRow('users', 'area', $row->name); ?></td>
                                <td class=" "><?php echo countRow2('users', 'area', $row->name, 'status', 'Active'); ?></td>
                                <td class=" "><?php echo countRow('users', 'area', $row->name) - countRow2('users', 'area', $row->name, 'status', 'Active'); ?></td>
                                <td class=" "><?php echo countRow('staff', 'area', $row->name); ?></td>
                                
                                <td class="action-link">
                                    <a href="<?php echo base_url(); ?>area/edit/<?php echo $row->id; ?>"><span class="label label-warning">Edit</span></a>
                                    <a href="<?php echo base_url(); ?>area/delete/<?php echo $row->id; ?>"><span class="label label-danger delete">Delete</span></a>
                                </td>	
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div><!-- Container -->