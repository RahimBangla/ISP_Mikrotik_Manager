<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/final/<?php echo favicon(); ?>" />
        <title><?php echo settings()[0]->name; ?> | <?php echo settings()[0]->slogan; ?></title>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">        
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rubik:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/r-2.2.1/datatables.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"/>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Chart.Js -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>


        <!--[if lt IE 9]>
            <script src="../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>
    <body class="nav-sm">

        <div class="col-md-12">
            <div class="top_nav">
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle" title="Single Click To Open"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-left">
                            <li class="top-title"><a class="white" href="<?php echo base_url(); ?>"><img class="logo" src="<?php echo base_url(); ?>assets/images/final/<?php echo logo(); ?>" alt=""><?php echo settings()[0]->name; ?> | <?php echo settings()[0]->slogan; ?></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url(); ?>assets/images/final/<?php echo currentUserPhoto(); ?>" alt=""><?php echo currentUsername(); ?> <i class="material-icons">arrow_drop_down</i>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="<?php echo base_url(); ?>user/view/<?php echo currentUserID(); ?>"><i class="material-icons">person</i> Profile</a></li>
                                    <?php if (notAdmin()) { ?>
                                        <li><a href="<?php echo base_url(); ?>settings"><i class="material-icons">settings</i> Settings</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>login/logout"><i class="material-icons">close</i> Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <?php if (kenadekha()) { ?>

                <div class="col-md-11 col-sm-11 col-xs-11 col-md-offset-1 rightSideWrapper">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="material-icons">close</i> Verify Your Purchase Code</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>settings/kenadekha" accept-charset="utf-8">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Code <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="purchasecode" type="text" placeholder="Purchase Code" required>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">                                                
                                        <button id="send" type="submit" class="btn btn-success"><i class="material-icons">verified_user</i> Verify Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 

            <?php } ?>



            <?php if ($this->session->flashdata('success')) { ?>
                <div class="col-md-offset-1 col-md-11">
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                </div>   
            <?php } else if ($this->session->flashdata('error')) { ?>
                <div class="col-md-offset-1 col-md-11">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                    </div>
                </div>   
            <?php } ?>
            
            <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-1 rightSideWrapper">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="material-icons">close</i> Verify Your Purchase Code</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <h4 class="title green text-center">Thank you for purchase. Not Purchase Yet, <a class="red" href="https://codecanyon.net/item/zal-isp-management-system/20275848" target="_blank">Purchase Now</a></h4>
                        <hr>
                        <h1 class="title red text-center">Please, Verify Your Purchase Code</h1>
                        <hr>
                        <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>verify/kenadekha" accept-charset="utf-8">
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <input class="form-control col-md-7 col-xs-12" name="purchasecode" type="text" placeholder="Purchase Code" required>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">                                                
                                    <button id="send" type="submit" class="btn btn-success"><i class="material-icons">verified_user</i> Verify Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
            <footer>
                <div class="">
                    <p class="pull-right"><?php echo settings()[0]->name; ?> | <?php echo settings()[0]->slogan; ?> | <?php echo settings()[0]->copyright; ?></p>
                </div>
                <div class="clearfix"></div>
            </footer>

            <script> var baseurl = "<?php echo base_url(); ?>";</script>    
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/b-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/r-2.2.1/datatables.min.js"></script>

            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/validator/validator.js"></script> 

    </body>
</html>