
<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">  
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart fa-fw"></i> Payment Statistics</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row tile_count">
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">assignment_turned_in</i> Total Balances</span>
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
            <h2><i class="material-icons">add</i> Edit Balance</h2>                
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-12">
                <?php foreach($balances as $row) : ?>
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>balance/update" accept-charset="utf-8">
                    <input type="hidden" name="id" value="<?php echo $row->id;?>">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="title" value="<?php echo $row->title; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" class="form-control" name="date" value="<?php echo $row->date; ?>" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Type <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="month" name="type">        
                                <option selected value="<?php echo $row->type; ?>"><?php echo $row->type; ?></option>
                                <option value="Income">Income</option>                                
                                <option value="Expense">Expense</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" step="0.01" class="form-control" name="amount" value="<?php echo $row->amount; ?>" required>
                        </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">                                                
                            <button id="send" type="submit" class="btn btn-success"><i class="material-icons">add</i> Add Now</button>
                        </div>
                    </div>
                </form>
                
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

</div><!-- Container -->

    
