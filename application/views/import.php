
<div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="material-icons">add</i> Import</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>import/userImport" accept-charset="utf-8">
                <div class="col-md-6">
                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-5 col-xs-12">Import Users/Clients</label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" name="user" type="file">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-0">                                                
                            <a class="btn btn-success" href="<?php echo base_url();?>assets/files/CSVUser.csv"><i class="material-icons">attach_file</i> Sample File</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-0">                                                
                            <button id="send" type="Save Now!" class="btn btn-success"><i class="material-icons">add</i> Add Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div><!-- Container -->