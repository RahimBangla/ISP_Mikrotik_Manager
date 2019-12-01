
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">add</i> Add Bill</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <h3 class="text-center">Generate Auto Invoices & Bills</h3>
                <hr>
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>bill/autogenerate" accept-charset="utf-8">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Create Date <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" class="form-control" id="createdate" name="createdate" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" class="form-control" id="duedate" name="duedate" required>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" class="btn btn-success"><i class="material-icons">add</i> Generate Now</button>
                        </div>
                    </div>
                </form>

                <hr>
                <h3 class="text-center">Generate Manually Invoices & Bills</h3>
                <hr>
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>bill/insert" accept-charset="utf-8">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="userid" name="userid">
                                <?php foreach ($users as $row) { ?>
                                <?php if(package($row->package) !=false){ ?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?> | <?php echo package($row->package)->packname . " (" . package($row->package)->packvolume . ") (" . package($row->package)->packprice . ") (" . package($row->package)->total . ")" ; ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Paid <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="status" name="status">
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="date" class="form-control" id="createdate" name="createdate" required>
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
    </div><!-- Container -->
