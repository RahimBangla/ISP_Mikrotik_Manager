
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">receipt</i> All Invoices</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="dtInvoices table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">No </th>
                            <th class="column-title" style="display: table-cell;"># Invoice </th>
                            <th class="column-title" style="display: table-cell;">Name </th>
                            <th class="column-title" style="display: table-cell;">Package </th>
                            <th class="column-title" style="display: table-cell;">Status </th>
                            <th class="column-title" style="display: table-cell;">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($invoices as $row) { $i++; ?>
                            <tr class="eventpointer">
                                <td class=" "><?php echo $i; ?></td>
                                <td class=" "><?php echo $row->invoiceID; ?></td>
                                <td class=" "><?php echo (getUser($row->userid)) ? getUser($row->userid)->name : "N/A"; ?></td>
                                <?php if(getUser($row->userid)){
                                    if(package(getUser($row->userid)->package)){ ?>
                                      <td class=" "><span class="label label-primary"><?php echo package(getUser($row->userid)->package)->packname . " (" . package(getUser($row->userid)->package)->packvolume . ") (" . package(getUser($row->userid)->package)->packprice . ") (" . package(getUser($row->userid)->package)->total . ")" ; ?></span></td>
                                    <?php }else{?>
                                      <td class=" ">N/A</td>
                                    <?php }
                                }else{ ?>
                                  <td class=" ">N/A</td>
                                <?php } ?>

                                <?php if($row->status == "Unpaid" || $row->status == " "){ ?>
                                    <td class=" "><span class="label label-warning"><?php echo $row->status; ?></td>
                                <?php }else{ ?>
                                    <td class=" "><span class="label label-success"><?php echo $row->status; ?></td>
                                <?php }?>

                                <td class="action-link">

                                    <?php if(getUser($row->userid)){ ?>

                                      <?php if(package(getUser($row->userid)->package)){ ?>
                                        <a href="<?php echo base_url(); ?>invoice/view/<?php echo $row->invoiceID; ?>"><span class="label label-primary">View</span></a>
                                      <?php }else{ ?>
                                        <a href="#"><span class="label label-danger">Package Not Found</span></a>
                                      <?php } ?>
                                    <?php }else{ ?>
                                        <a href="#"><span class="label label-danger">Package Not Found</span></a>
                                    <?php } ?>

                                    <a href="<?php echo base_url(); ?>invoice/delete/<?php echo $row->invoiceID; ?>"><span class="label label-danger delete">Delete</span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div><!-- Container -->
