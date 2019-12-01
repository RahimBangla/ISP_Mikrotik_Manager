
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">search</i> Browse Bills</h2>                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>bill/browse" accept-charset="utf-8">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Month <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">                            
                            <select class="form-control" id="month" name="month">
                                <option selected value="<?php echo date('F'); ?>"><?php echo date('F'); ?></option>   
                                <option value="Janaury">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>                                      
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Year <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="year" name="year">
                                <option selected value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>                                       
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
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">                                               
                            <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">search</i> View</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php if ($bills_paid) { ?>
        <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">     
            <div class="x_panel">
                <div class="x_title"> 
                    <h2><i class="material-icons">group</i> Paid Users |
                        <?php if ($bills_paid) { ?>
                            <?php
                            $i = 0;
                            foreach ($bills_paid as $row) {
                                ?>
                                <?php echo $row->month; ?>, <?php echo $row->year; ?>
                                <?php
                                $i++;
                                if ($i == 1)
                                    break;
                            }
                            ?>
                        <?php } else { ?>
                            <span style="color:#FFEB3B">No Bills Found On This Date</span>
                        <?php } ?>
                    </h2>                
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="dtPaidBills table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                            <tr class="headings">                                             
                                <th class="column-title" style="display: table-cell;">No </th>
                                <th class="column-title" style="display: table-cell;">Photo </th>
                                <th class="column-title" style="display: table-cell;">Name </th>
                                <th class="column-title" style="display: table-cell;">Mobile </th>
                                <th class="column-title" style="display: table-cell;">Package </th>
                                <th class="column-title" style="display: table-cell;">Status </th>
                                <th class="column-title" style="display: table-cell;">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($bills_paid as $row) {
                                $i++;
                                ?>
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
                                    <td class=""><span class="label label-<?php
                                        if ($row->billstatus == "Paid") {
                                            echo "success";
                                        } elseif ($row->billstatus == "Unpaid") {
                                            echo "warning";
                                        } else {
                                            echo "warning";
                                        }
                                        ?>"><?php echo $row->billstatus; ?></span></td>
                                    <td class="action-link">
                                        <?php if(invoiceByUser($row->userid)){ ?>
                                           <a href="<?php echo base_url(); ?>invoice/view/<?php echo invoiceByUser($row->userid)->invoiceID; ?>" target="_blank"><span class="label label-primary">Invoice</span></a>
                                         <?php } ?>
                                        <a href="<?php echo base_url(); ?>bill/makeunpaid/<?php echo $row->billid; ?>"><span class="label label-warning">Make Unpaid</span></a>
                                        <a href="<?php echo base_url(); ?>bill/delete/<?php echo $row->billid; ?>"><span class="label label-danger delete">Delete</span></a>
                                    </td>	
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>

    <?php } ?>
        
    <?php if ($bills_unpaid) { ?>
        <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper"> 
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="material-icons">group</i> Unpaid Users |
                        <?php if ($bills_unpaid) { ?>
                            <?php
                            $i = 0;
                            foreach ($bills_unpaid as $row) {
                                ?>
                                <?php echo $row->month; ?>, <?php echo $row->year; ?>
                                <?php
                                $i++;
                                if ($i == 1)
                                    break;
                            }
                            ?>
                        <?php } else { ?>
                            <span style="color:#FFEB3B">Opps! Nothing Found</span>
                        <?php } ?>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="dtDueBills table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                            <tr class="headings">                                             
                                <th class="column-title" style="display: table-cell;">No </th>
                                <th class="column-title" style="display: table-cell;">Photo </th>
                                <th class="column-title" style="display: table-cell;">Name </th>
                                <th class="column-title" style="display: table-cell;">Mobile </th>
                                <th class="column-title" style="display: table-cell;">Package </th>
                                <th class="column-title" style="display: table-cell;">Status </th>
                                <th class="column-title" style="display: table-cell;">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($bills_unpaid as $row) {
                                $i++;
                                ?>

                                <tr class="even pointer">
                                    <td class=" "><?php echo $i; //echo $row->id;           ?></td>
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
                                    <td class=""><span class="label label-<?php
                                        if ($row->billstatus == "Paid") {
                                            echo "success";
                                        } elseif ($row->billstatus == "Unpaid") {
                                            echo "warning";
                                        } else {
                                            echo "warning";
                                        }
                                        ?>"><?php echo $row->billstatus; ?></span></td>
                                    <td class="action-link">
                                        <?php if(invoiceByUser($row->userid)){ ?>                                           
                                            <a href="<?php echo base_url(); ?>invoice/view/<?php echo invoiceByUser($row->userid)->invoiceID; ?>" target="_blank"><span class="label label-primary">Invoice</span></a>
                                        <?php } ?>
                                        <a href="<?php echo base_url(); ?>bill/makepaid/<?php echo $row->billid; ?>"><span class="label label-warning">Make Paid</span></a>
                                        <a href="<?php echo base_url(); ?>bill/delete/<?php echo $row->billid; ?>"><span class="label label-danger delete">Delete</span></a>
                                    </td>			
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
    </div><!-- Container -->