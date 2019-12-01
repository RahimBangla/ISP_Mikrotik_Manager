<?php foreach ($package as $row) : ?>

    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">add</i> Edit Package</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>package/update" accept-charset="utf-8">
                    <input type="hidden" name="packid" value="<?php echo $row->packid; ?>">
                    <div class="row">
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Package Name <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="name" type="text" placeholder="Package Name" value="<?php echo $row->packname; ?>" required>
                            </div>
                        </div>                    
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Package Code <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="code" type="text" placeholder="Package Code" value="<?php echo $row->code; ?>" required>
                            </div>
                        </div>  
                    </div> 
                    <div class="row">
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Regular Price <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="price" type="number" placeholder="Package Price" value="<?php echo $row->packprice; ?>" required>
                            </div>
                        </div>
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Package Volume <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="volume" type="text" placeholder="Package Volume" value="<?php echo $row->packvolume; ?>" required>
                            </div>
                        </div>  
                    </div>
                    
                    <hr>
                    <h3 class="text-center">Monthly Costs & Prices <br> <small>All Costs Will Be Calculated When Billing & Invoicing </small></h3>
                    <hr>
                    
                    <div class="row">
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Extra Cost 01</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="cost1" type="text" value="<?php echo $row->cost1; ?>" placeholder="Package Extra Service/Cost Name">
                            </div>
                        </div>
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Value 01</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="value1" type="number" value="<?php echo $row->value1; ?>" placeholder="Package Extra Service/Cost Value">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Extra Cost 02</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="cost2" type="text" value="<?php echo $row->cost2; ?>" placeholder="Package Extra Service/Cost Name">
                            </div>
                        </div>
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Value 02</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="value2" type="number" value="<?php echo $row->value2; ?>" placeholder="Package Extra Service/Cost Value">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Extra Cost 03</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="cost3" type="text" value="<?php echo $row->cost3; ?>" placeholder="Package Extra Service/Cost Name">
                            </div>
                        </div>
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Value 03</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="value3" type="number" value="<?php echo $row->value3; ?>" placeholder="Package Extra Service/Cost Value">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Extra Cost 04</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="cost4" type="text" value="<?php echo $row->cost4; ?>" placeholder="Package Extra Service/Cost Name">
                            </div>
                        </div>
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Value 04</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="value4" type="number" value="<?php echo $row->value4; ?>" placeholder="Package Extra Service/Cost Value">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Extra Cost 05</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="cost5" type="text" value="<?php echo $row->cost5; ?>" placeholder="Package Extra Service/Cost Name">
                            </div>
                        </div>
                        <div class="item form-group col-md-6">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Value 05</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="value5" type="number" value="<?php echo $row->value5; ?>" placeholder="Package Extra Service/Cost Value">
                            </div>
                        </div>
                    </div>
                    
                                
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-10">                                                
                            <button id="send" type="Save Now" class="btn btn-success"><i class="material-icons">add</i> Update Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div><!-- Container -->
    
    <?php endforeach; ?>