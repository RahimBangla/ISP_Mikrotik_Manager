
<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart fa-fw"></i> Payment & Income/Expense Chart</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row tile_count">
                <div class="col-md-6">
                    <canvas id="payemntsChart" width="400" height="150"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="balancesChart" width="400" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart fa-fw"></i> Area & Staff Chart</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row tile_count">
                <div class="col-md-5 col-md-offset-1">
                    <h3 class="title text-center">Total Users In Each Area</h3>
                    <canvas id="areaChart" width="400" height="200"></canvas>
                </div>
                <div class="col-md-5">
                    <h3 class="title text-center">Total Users Under Each Staff</h3>
                    <canvas id="staffChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart fa-fw"></i> User Statistics</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row tile_count">
                <div class="animated flipInY col-md-3 col-sm-3 col-xs-3 tile_stats_count">
                    <span class="count_top"><i class="material-icons">group</i> Total Users</span>
                    <div class="count blue"><?php
                        $this->db->from('users');
                        echo $this->db->count_all_results();
                        ?>.00</div>
                </div>
                <div class="animated flipInY col-md-3 col-sm-3 col-xs-3 tile_stats_count">
                    <span class="count_top"><i class="material-icons">access_time</i> Pending Users</span>
                    <div class="count warning"><?php
                        $this->db->like('status', 'Pending');
                        $this->db->from('users');
                        echo $this->db->count_all_results();
                        ?>.00</div>
                </div>
                <div class="animated flipInY col-md-3 col-sm-3 col-xs-3 tile_stats_count">
                    <span class="count_top"><i class="material-icons">check</i> Active Users</span>
                    <div class="count green"><?php
                        $this->db->like('status', 'Deactive');
                        $this->db->from('users');
                        $deactive_users = $this->db->count_all_results();
                        $this->db->like('status', 'Active');
                        $this->db->from('users');
                        $active_users = $this->db->count_all_results();
                        echo $active_users - $deactive_users;
                        ?>.00</div>
                </div>
                <div class="animated flipInY col-md-3 col-sm-3 col-xs-3 tile_stats_count">
                    <span class="count_top"><i class="material-icons">clear</i> Deactivated Users</span>
                    <div class="count red"><?php
                        $this->db->like('status', 'Deactive');
                        $this->db->from('users');
                        echo $this->db->count_all_results();
                        ?>.00</div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart fa-fw"></i> Invoice Statistics</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row tile_count">
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">receipt</i> Total Invoices</span>
                    <div class="count blue"><?php
                        $this->db->from('invoice');
                        echo $this->db->count_all_results();
                        ?>.00</div>
                </div>
                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">receipt</i> Paid Invoices</span>
                    <div class="count green"><?php
//                        $this->db->like('status', 'Paid');
                        $this->db->from('invoice');
                        $totalInvoice =  $this->db->count_all_results();

                        $this->db->like('status', 'Unpaid');
                        $this->db->from('invoice');
                        $totalUnpaidInvoice =  $this->db->count_all_results();

                        echo $totalInvoice - $totalUnpaidInvoice;

                        ?>.00</div>
                </div>

                <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
                    <span class="count_top"><i class="material-icons">receipt</i> Unpaid Invoices</span>
                    <div class="count red"><?php
                        $this->db->like('status', 'Unpaid');
                        $this->db->from('invoice');
                        echo $this->db->count_all_results();
                        ?>.00</div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
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
    <div class="clearfix"></div>
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

    <div class="clearfix"></div>

    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">group</i> Recent Users</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="dtHomeTable table table-striped responsive-utilities jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title" style="display: table-cell;">No </th>
                        <th class="column-title" style="display: table-cell;">Photo </th>
                        <th class="column-title" style="display: table-cell;">Name </th>
                        <th class="column-title" style="display: table-cell;">Phone </th>
                        <th class="column-title" style="display: table-cell;">Package </th>
                        <th class="column-title" style="display: table-cell;">ID </th>
                        <th class="column-title" style="display: table-cell;">Password </th>
                        <th class="column-title" style="display: table-cell;">Location </th>
                        <th class="column-title" style="display: table-cell;">Status </th>
                        <th class="column-title" style="display: table-cell;">Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($users as $row) {
                        $i++;
                        ?>
                        <tr class="even pointer">
                            <td class=" "><?php echo $i; ?></td>
                            <?php if ($row->photo) { ?>
                                <td class=" "><img class="userPhoto" src="<?php echo base_url() . "assets/images/final/" . $row->photo; ?>" alt="Photo"></td>
                            <?php } else { ?>
                                <td class=" "><img class="userPhoto" src="<?php echo base_url() ?>assets/images/user.png" alt="Photo"></td>
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
                            <td class=" "><span class="label label-primary"><?php echo $row->location; ?></span></td>
                            <td class=""><span class="label label-<?php
                                if ($row->status == "Active") {
                                    echo "success";
                                } elseif ($row->status == "Pending") {
                                    echo "primary";
                                } else {
                                    echo "warning";
                                }
                                ?>"><?php echo $row->status; ?></span></td>
                            <td class="action-link"><a href="<?php echo base_url(); ?>user/view/<?php echo $row->id; ?>/"><span class="label label-success">View</span></a> <a href="<?php echo base_url(); ?>user/edit/<?php echo $row->id; ?>/"><span class="label label-warning">Edit</span></a> <a href="<?php echo base_url(); ?>user/delete/<?php echo $row->id; ?>/" ><span class="label label-danger delete">Delete</span></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div><!-- Container -->


<script>

$(document).ready(function () {

    var ctxPayments = document.getElementById("payemntsChart");
    var paymentsChart = new Chart(ctxPayments, {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
            label: 'Payments',
                    data: ["<?php echo $jan; ?>", "<?php echo $feb; ?>", "<?php echo $mar; ?>", "<?php echo $apr; ?>", "<?php echo $may; ?>", "<?php echo $jun; ?>", "<?php echo $jul; ?>", "<?php echo $aug; ?>", "<?php echo $sep; ?>", "<?php echo $oct; ?>", "<?php echo $nov; ?>", "<?php echo $dec; ?>"],
                    backgroundColor: "rgba(64, 210, 173, 0.4)"
            }]
        }
    });


    var ctxBalance = document.getElementById("balancesChart");
    var balanceChart = new Chart(ctxBalance, {
        type: 'line',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
            label: 'Income',
                    data: ["<?php echo $janIncome; ?>", "<?php echo $febIncome; ?>", "<?php echo $marIncome; ?>", "<?php echo $aprIncome; ?>", "<?php echo $mayIncome; ?>", "<?php echo $junIncome; ?>", "<?php echo $julIncome; ?>", "<?php echo $augIncome; ?>", "<?php echo $sepIncome; ?>", "<?php echo $octIncome; ?>", "<?php echo $novIncome; ?>", "<?php echo $decIncome; ?>"],
                    backgroundColor: "rgba(64, 210, 173, 0.4)"
            }, {
            label: 'Expense',
                    data: ["<?php echo $janExpense; ?>", "<?php echo $febExpense; ?>", "<?php echo $marExpense; ?>", "<?php echo $aprExpense; ?>", "<?php echo $mayExpense; ?>", "<?php echo $junExpense; ?>", "<?php echo $julExpense; ?>", "<?php echo $augExpense; ?>", "<?php echo $sepExpense; ?>", "<?php echo $octExpense; ?>", "<?php echo $novExpense; ?>", "<?php echo $decExpense; ?>"],
                    backgroundColor: "rgba(49, 163, 253, 0.4)"
            }]
        }
    });


    var ctxAreaChart = document.getElementById("areaChart");
    var areaChart = new Chart(ctxAreaChart, {
        type: 'doughnut',
        data: {
            labels: [<?php $i = 0; $count = count($areas); foreach ($areas as $area) { $i++;
                echo '"' . preg_replace('/[^a-zA-Z0-9]/', '', $area->name) . '"'; if ($i < $count) { echo ","; }
                } ?>],
            datasets: [{
                label: "Area Chart",
                data: [<?php $i = 0; $count = count($areas); foreach ($areas as $area) { $i++;
                        echo countUserByArea($area->name); if ($i < $count) { echo ","; }
                    } ?>],
                backgroundColor: ["rgb(229, 115, 115)", "rgb(100, 181, 246)", "rgb(255, 213, 79)", "rgb(174, 213, 129)", "rgb(186, 104, 200)", "rgb(77, 208, 225)", "rgb(255, 183, 77)", "rgb(77, 182, 172)", "rgb(121, 134, 203)", "rgb(220, 231, 117)", "rgb(255, 241, 118)", "rgb(255, 138, 101)", "rgb(149, 117, 205)", "rgb(174, 213, 129)", "rgb(161, 136, 127)", "rgb(144, 164, 174)", "rgb(255,112,67)", "rgb(141,110,99)", "rgb(189,189,189)", "rgb(120,144,156)"]
            }]
        },
         options: {
              legend: {
                 display: false
              },
              tooltips: {
                 enabled: true
              }
         }
    });

    var ctxStaffChart = document.getElementById("staffChart");
    var staffChart = new Chart(ctxStaffChart, {
        type: 'doughnut',
        data: {
            labels: [<?php $i = 0; $count = count($staffs); foreach ($staffs as $staff) { $i++;
                echo '"' . $staff->name . '"'; if ($i < $count) { echo ","; }
                } ?>],
            datasets: [{
                label: "Area Chart",
                data: [<?php $i = 0; $count = count($staffs); foreach ($staffs as $staff) { $i++;
                        echo countUserByStaff($staff->id); if ($i < $count) { echo ","; }
                    } ?>],
                backgroundColor: ["rgb(229, 115, 115)", "rgb(100, 181, 246)", "rgb(255, 213, 79)", "rgb(174, 213, 129)", "rgb(186, 104, 200)", "rgb(77, 208, 225)", "rgb(255, 183, 77)", "rgb(77, 182, 172)", "rgb(121, 134, 203)", "rgb(220, 231, 117)", "rgb(255, 241, 118)", "rgb(255, 138, 101)", "rgb(149, 117, 205)", "rgb(174, 213, 129)", "rgb(161, 136, 127)", "rgb(144, 164, 174)", "rgb(255,112,67)", "rgb(141,110,99)", "rgb(189,189,189)", "rgb(120,144,156)"]

            }]
        },
        options: {
             legend: {
                display: false
             },
             tooltips: {
                enabled: true
             }
        }
    });

});

</script>
