
<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">  
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart fa-fw"></i> Payment Statistics</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row tile_count">
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">assignment_turned_in</i> Total Payments</span>
                    <div class="count blue"><?php
                        $this->db->from('payments');
                        echo $this->db->count_all_results();
                        ?>.00</div>
                </div>
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">assignment_turned_in</i> This Month</span>
                    <div class="count blue"><?php
                        $this->db->where('month(saletime)', date('m'));
                        $this->db->where('year(saletime)', date('Y'));
                        //$this->db->like('status', 'Paid');
                        $this->db->from('payments');
                        echo $this->db->count_all_results();
                        ?>.00</div>
                </div>
                
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">assignment_turned_in</i> This Year</span>
                    <div class="count blue"><?php
                        $this->db->where('year(saletime)', date('Y'));
                        //$this->db->like('status', 'Paid');
                        $this->db->from('payments');
                        echo $this->db->count_all_results();
                        ?>.00</div>
                </div>
            </div>
            
            <div class="row tile_count">    
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">assignment_turned_in</i> Total Amount ( <?php echo settings()[0]->currency; ?> )</span>
                    <div class="count blue"><?php
                        $this->db->select_sum('amount'); 
                        $this->db->from('payments');
                        $subOfPay = $this->db->get();
                        $subOfPay = $subOfPay->result()[0];
                        echo number_format($subOfPay->amount, 2);
                        ?></div>  
                </div>
                
                
                
<!--                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">assignment_turned_in</i> Day's Amount</span>
                    <div class="count blue"><?php
                        $this->db->select_sum('amount'); 
                        $this->db->from('payments');
                        $this->db->where('day(saletime)', date('d'));
                        $subOfPay = $this->db->get();
                        $subOfPay = $subOfPay->result()[0];
                        echo number_format($subOfPay->amount, 2);
                        ?></div>
                </div>-->
                
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">assignment_turned_in</i> Month's Amount ( <?php echo settings()[0]->currency; ?> )</span>
                    <div class="count blue"><?php
                        $this->db->select_sum('amount'); 
                        $this->db->from('payments');
                        $this->db->where('month(saletime)', date('m'));
                        $subOfPay = $this->db->get();
                        $subOfPay = $subOfPay->result()[0];
                        echo number_format($subOfPay->amount, 2);
                        ?></div>
                </div>
                        
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">assignment_turned_in</i> Year's Amount ( <?php echo settings()[0]->currency; ?> ) </span>
                    <div class="count blue"><?php
                        $this->db->select_sum('amount'); 
                        $this->db->from('payments');
                        $this->db->where('year(saletime)', date('Y'));
                        $subOfPay = $this->db->get();
                        $subOfPay = $subOfPay->result()[0];
                        echo number_format($subOfPay->amount, 2);
                        ?></div>
                </div>
            </div>  
            
        </div>
    </div>
</div>    

<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">     
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">add</i> Browse Payments By Month & Year</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">            
            <div class="col-md-6">
                <h3>Browse By Month</h3>
                <hr>
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>payments/bymonth" accept-charset="utf-8">
                
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Month <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="month" name="month"> 
                                <option selected value="<?php echo date('m'); ?>"><?php echo date('F'); ?></option>     
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Year <span class="required">*</span></label>
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
                            <button id="send" type="submit" class="btn btn-success"><i class="material-icons">search</i> Browse Now</button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="col-md-6">
                <h3>Browse By Year</h3>
                <hr>
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>payments/byyear" accept-charset="utf-8">
                
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Year <span class="required">*</span></label>
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
                            <button id="send" type="submit" class="btn btn-success"><i class="material-icons">search</i> Browse Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">        
    <div class="x_panel">
        <div class="x_title"> 
            <h2><i class="material-icons">receipt</i> All Payments</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="dtPayments table table-striped responsive-utilities jambo_table bulk_action">
                <thead>
                    <tr class="headings">                                             
                        <th class="column-title" style="display: table-cell;">No </th>
                        <th class="column-title" style="display: table-cell;"># Invoice </th>
                        <th class="column-title" style="display: table-cell;">Method </th>
                        <th class="column-title" style="display: table-cell;">Amount </th>
                        <th class="column-title" style="display: table-cell;">Payer Info </th>
                        <th class="column-title" style="display: table-cell;">Time</th>
                        <th class="column-title" style="display: table-cell;">Status </th>
                        <th class="column-title" style="display: table-cell;">Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($payments as $row) {
                        $i++;
                        ?>
                        <tr class="eventpointer">
                            <td class=" "><?php echo $i; ?></td>
                            <td class=" "><?php echo $row->invoiceid; ?></td>
                            <td class=" "><?php echo $row->method; ?></td>
                            <td class=" "><?php echo $row->currency . " " . number_format($row->amount, 2); ?></td>
                            <td class=" "><?php echo $row->payeremail; ?></td>
                            <td class=" "><?php echo date('Y-m-d', strtotime($row->saletime)); ?></td>
                            <td class=""><span class="label label-<?php
                                if ($row->status == "Paid") {
                                    echo "success";
                                } else {
                                    echo "warning";
                                }
                                ?>"><?php echo $row->status; ?></span></td>
                            <td class="action-link">
                                <a href="<?php echo base_url(); ?>payments/delete/<?php echo $row->paymentid; ?>"><span class="label label-danger delete">Delete</span></a>
                            </td>	
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>        
</div>
</div><!-- Container -->