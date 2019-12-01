
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">view_list</i> All Tickets</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="dtPackages table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">No </th>
                            <?php if(notAdmin() == true){ ?>
                                <th class="column-title" style="display: table-cell;">User </th>
                            <?php } ?>
                            <th class="column-title" style="display: table-cell;">Title </th>
                            <th class="column-title" style="display: table-cell;">Description </th>
                            <th class="column-title" style="display: table-cell;">Date </th>
                            <th class="column-title" style="display: table-cell;">Status </th>
                            <th class="column-title" style="display: table-cell;">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($tickets as $row) { $i++; ?>
                            <tr class="eventpointer">
                                <td class=" "><?php echo $i; ?></td>
                                <?php if(notAdmin() == true){ ?>
                                    <td class=" "><?php echo (getUser($row->userID) != false ) ? getUser($row->userID)->name : "N/A"; ?></td>
                                <?php } ?>
                                <td class=" "><?php echo word_limiter($row->title, 5); ?></td>
                                <td class=" "><?php echo word_limiter($row->description, 8); ?></td>
                                <td class=" "><?php echo $row->ticketdate; ?></td>
                                <td class="action-link">
                                    <a href="#"><span class="label label-success"><?php echo $row->status; ?></span></a>
                                </td>
                                <td class="action-link">
                                    <a href="<?php echo base_url(); ?>ticket/view/<?php echo $row->ticketID; ?>"><span class="label label-primary">View</span></a>
                                    <a href="<?php echo base_url(); ?>ticket/edit/<?php echo $row->ticketID; ?>"><span class="label label-warning">Edit</span></a>
                                    <?php if(notAdmin() == true){ ?>
                                        <a href="<?php echo base_url(); ?>ticket/solve/<?php echo $row->ticketID; ?>"><span class="label label-success">Close</span></a>

                                        <a href="<?php echo base_url(); ?>ticket/delete/<?php echo $row->ticketID; ?>"><span class="label label-danger delete">Delete</span></a>
                                    <?php } ?>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div><!-- Container -->
