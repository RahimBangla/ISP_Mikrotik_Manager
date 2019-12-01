
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">view_list</i> All Packages</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="dtPackages table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">No </th>
                            <th class="column-title" style="display: table-cell;">Name </th>
                            <th class="column-title" style="display: table-cell;">Volume </th>
                            <th class="column-title" style="display: table-cell;">Users </th>
                            <th class="column-title" style="display: table-cell;">Active </th>
                            <th class="column-title" style="display: table-cell;">Regular Price </th>
                            <th class="column-title" style="display: table-cell;">Total Extra </th>
                            <th class="column-title" style="display: table-cell;">Net Total</th>
                            <th class="column-title" style="display: table-cell;">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($packages as $row) { $i++; ?>
                            <tr class="eventpointer">
                                <td class=" "><?php echo $i; ?></td>
                                <td class=" "><?php echo $row->packname; ?></td>
                                <td class=" "><?php echo $row->packvolume; ?></td>
                                <td class=" "><?php echo countRow('users', 'package', $row->packid); ?></td>
                                <td class=" "><?php echo countRow2('users', 'package', $row->packid, 'status', 'Active'); ?></td>
                                <td class=" "><?php echo settings()[0]->currency . " " . number_format($row->packprice, 2); ?></td>
                                <td class=" "><?php echo settings()[0]->currency . " " . number_format($row->total, 2); ?></td>
                                <td class=" "><?php echo settings()[0]->currency . " " . number_format($row->total + $row->packprice, 2); ?></td>
                                <td class="action-link">
                                    <a href="<?php echo base_url(); ?>package/edit/<?php echo $row->packid; ?>"><span class="label label-warning">Edit</span></a>
                                    <a href="<?php echo base_url(); ?>package/delete/<?php echo $row->packid; ?>"><span class="label label-danger delete">Delete</span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div><!-- Container -->
