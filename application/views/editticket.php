
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">add</i> Update Ticket</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>ticket/update" accept-charset="utf-8">
                    <?php foreach($ticket as $row): ?>
                    <input type="hidden" name="ticketID" value="<?php echo $row->ticketID;?>">
                    <div class="row">
                        <div class="item form-group col-md-10">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ticket Title <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input class="form-control col-md-7 col-xs-12" name="title" type="text" placeholder="Ticket Title/Reason/Problem" value="<?php echo $row->title;?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item form-group col-md-10">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ticket Description <span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea class="form-control col-md-7 col-xs-12" name="description" type="text" placeholder="Describe your problem here" required><?php echo $row->description;?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-10">
                            <button id="send" type="Save Now" class="btn btn-success"><i class="material-icons">add</i> Submit Now</button>
                        </div>
                    </div>
                <?php endforeach; ?>
                </form>
            </div>
        </div>
    </div>
    </div><!-- Container -->
