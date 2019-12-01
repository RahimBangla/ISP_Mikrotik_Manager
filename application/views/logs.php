
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        
        <?php if(!empty($systemInfo)){ ?>
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bar-chart fa-fw"></i> System Status</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row tile_count">
                        <?php foreach ($systemInfo as $sys) { ?>
                            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top">System Uptime</span>
                              <div class="count"><?php
                               $new_str = preg_replace('~[m]~', ':', $sys('uptime'));
                               $new_str = preg_replace('~[d]~', ':', $new_str);
                               $new_str = preg_replace('~[h]~', ':', $new_str);
                               echo $new_str = preg_replace('~[s]~', '', $new_str);
                               ?></div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top">CPU Load</span>
                              <div class="count"><?php echo $sys('cpu-load'); ?>%</div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top">CPU Frequency/MHz</span>
                              <div class="count green"><?php echo $sys('cpu-frequency'); ?></div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top">Free Memory/MB</span>
                              <div class="count green"><?php echo round($sys('free-memory')/1024/1024,2); ?></div>
                            </div>
                        <?php } ?>
                  </div>
                </div>
            </div>
        <?php } ?>

        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">perm_identity</i> System Session Logs</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if(!empty($logs)){ ?>
                <table class="dtPackages table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">No </th>
                            <th class="column-title" style="display: table-cell;">Time </th>
                            <th class="column-title" style="display: table-cell;">Topic </th>
                            <th class="column-title" style="display: table-cell;">Description </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($logs as $row) { $i++; ?>
                            <tr class="eventpointer">
                                <td class=" "><?php echo $i; ?></td>
                                <td class=" "><?php echo $row('time'); ?></td>
                                <td class=" "><?php echo $row('topics'); ?></td>
                                <td class=" "><?php echo $row('message'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }else{
                echo $error;
            } ?>
            </div>
        </div>
    </div>
    </div><!-- Container -->
