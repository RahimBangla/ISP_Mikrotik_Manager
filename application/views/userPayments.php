    
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($payments){
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
                        </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>        
</div>
</div><!-- Container -->