
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">group</i> All Interfaces </h2>
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
                            <th class="column-title" style="display: table-cell;">Uptime </th>
                            <th class="column-title" style="display: table-cell;">Dowload </th>
                            <th class="column-title" style="display: table-cell;">Upload </th>
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
                                <td class="action-link"><a href="<?php echo base_url(); ?>user/view/<?php echo $row->id; ?>/"><span class="label label-success">View</span></a> <a href="<?php echo base_url(); ?>user/edit/<?php echo $row->id; ?>/" ><span class="label label-warning">Edit</span></a> <a href="<?php echo base_url(); ?>user/delete/<?php echo $row->id; ?>/" ><span class="label label-danger delete">Delete</span></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div><!-- Container -->
