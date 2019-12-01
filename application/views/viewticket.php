
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="material-icons">add</i> View Ticket</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php foreach($ticket as $row): ?>
                    <div class="row">
                        <div class="item form-group col-md-6">
                            <div class="col-md-12">
                                <h2><b><?php echo $row->title;?></b></h2>
                            </div>
                            <div class="col-md-12">
                                <p>
                                    <?php echo $row->description;?>
                                </p>
                                <br />
                                <p>
                                    <b>User:</b> <?php echo getUser($row->userID)->user_id;?> | <b>Submit Date:</b> <?php echo $row->ticketdate;?> | <b>Status:</b> <?php echo $row->status;?>
                                </p>
                                <div class="ln_solid"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>ticket/comment" accept-charset="utf-8">
                                <input type="hidden" name="ticketID" value="<?php echo $row->ticketID;?>">
                                <div class="row">
                                    <div class="item form-group col-md-12">
                                        <!-- <label class="control-label col-md-12 col-sm-12 col-xs-12">Ticket Comment</label> -->
                                        <div class="ln_solid"></div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <textarea class="form-control col-md-7 col-xs-12" name="comment" type="text" placeholder="Put a comment on this ticket" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button id="send" type="Save Now" class="btn btn-success"><i class="material-icons">add</i> Comment Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="item form-group col-md-6">
                        <?php foreach($comments as $comment){ ?>
                            <div class="col-md-12 commentList">
                                <p>
                                    <?php echo $comment->comment;?>
                                </p>
                                <p>
                                    <b><?php echo ($comment->usertype == 1) ? 'Admin Comment' : 'User Comment';?></b> | <b>Comment Date:</b> <?php echo $comment->commentdate;?>
                                </p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </div><!-- Container -->
