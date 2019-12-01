
<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart fa-fw"></i> Income/Expense Statistics</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row tile_count">
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">attach_money</i> Total Income ( <?php echo settings()[0]->currency; ?> )</span>
                    <div class="count green"><?php
                        $this->db->select_sum('amount');
                        $this->db->from('balance');
                        $this->db->like('type', 'Income');
                        $sum = $this->db->get();
                        $sum = $sum->result()[0];
                        echo number_format($sum->amount, 2);
                        ?></div>
                </div>
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">attach_money</i> This Month ( <?php echo settings()[0]->currency; ?> )</span>
                    <div class="count green"><?php
                        $this->db->select_sum('amount');
                        $this->db->from('balance');
                        $this->db->like('type', 'Income');
                        $this->db->where('month(date)', date('m'));
                        $this->db->where('year(date)', date('Y'));
                        $sum = $this->db->get();
                        $sum = $sum->result()[0];
                        echo number_format($sum->amount, 2);
                        ?></div>
                </div>

                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">attach_money</i> This Year ( <?php echo settings()[0]->currency; ?> )</span>
                    <div class="count green"><?php
                        $this->db->select_sum('amount');
                        $this->db->from('balance');
                        $this->db->like('type', 'Income');
                        $this->db->where('year(date)', date('Y'));
                        $sum = $this->db->get();
                        $sum = $sum->result()[0];
                        echo number_format($sum->amount, 2);
                        ?></div>
                </div>
            </div>

            <div class="row tile_count">
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">attach_money</i> Total Expense ( <?php echo settings()[0]->currency; ?> )</span>
                    <div class="count red"><?php
                        $this->db->select_sum('amount');
                        $this->db->from('balance');
                        $this->db->like('type', 'Expense');
                        $sum = $this->db->get();
                        $sum = $sum->result()[0];
                        echo number_format($sum->amount, 2);
                        ?></div>
                </div>
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">attach_money</i> This Month ( <?php echo settings()[0]->currency; ?> )</span>
                    <div class="count red"><?php
                        $this->db->select_sum('amount');
                        $this->db->from('balance');
                        $this->db->like('type', 'Expense');
                        $this->db->where('month(date)', date('m'));
                        $this->db->where('year(date)', date('Y'));
                        $sum = $this->db->get();
                        $sum = $sum->result()[0];
                        echo number_format($sum->amount, 2);
                        ?></div>
                </div>

                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">attach_money</i> This Year ( <?php echo settings()[0]->currency; ?> )</span>
                    <div class="count red"><?php
                        $this->db->select_sum('amount');
                        $this->db->from('balance');
                        $this->db->like('type', 'Expense');
                        $this->db->where('year(date)', date('Y'));
                        $sum = $this->db->get();
                        $sum = $sum->result()[0];
                        echo number_format($sum->amount, 2);
                        ?></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">add</i> Insert Balance</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-12">
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>balance/insert" accept-charset="utf-8">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" class="form-control" name="title" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Type <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="month" name="type">
                                <option value="Income">Income</option>
                                <option value="Expense">Expense</option>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" step="0.01" class="form-control" name="amount" required>
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
    </div>
</div>

<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">add</i> Browse Balances By Month & Year</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="col-md-6">
                <h3>Browse By Month</h3>
                <hr>
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>balance/bymonth" accept-charset="utf-8">

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
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>balance/byyear" accept-charset="utf-8">

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


    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">receipt</i> All Balances</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="dtBalances table table-striped responsive-utilities jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title" style="display: table-cell;">No </th>
                        <th class="column-title" style="display: table-cell;">Title </th>
                        <th class="column-title" style="display: table-cell;">Amount </th>
                        <th class="column-title" style="display: table-cell;">Date</th>
                        <th class="column-title" style="display: table-cell;">Type </th>
                        <th class="column-title" style="display: table-cell;">Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($balances as $row) {
                        $i++;
                        ?>
                        <tr class="eventpointer">
                            <td class=" "><?php echo $i; ?></td>
                            <td class=" "><?php echo $row->title; ?></td>
                            <td class=" "><?php echo settings()[0]->currency . " " . number_format($row->amount, 2); ?></td>
                            <td class=" "><?php echo date('Y-m-d', strtotime($row->date)); ?></td>
                            <td class=""><span class="label label-<?php
                                if ($row->type == "Income") {
                                    echo "success";
                                } else {
                                    echo "warning";
                                }
                                ?>"><?php echo $row->type; ?></span></td>
                            <td class="action-link">
                                <a href="<?php echo base_url(); ?>balance/edit/<?php echo $row->id; ?>"><span class="label label-warning">Edit</span></a>
                                <a href="<?php echo base_url(); ?>balance/delete/<?php echo $row->id; ?>"><span class="label label-danger delete">Delete</span></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</div><!-- Container -->
