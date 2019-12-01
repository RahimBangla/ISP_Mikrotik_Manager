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
                                            <?php if(notAdmin()){?>
                                            <li><a href="<?php echo base_url(); ?>settings"><i class="material-icons">settings</i> Settings</a></li>
                                            <li><a href="<?php echo base_url(); ?>update"><i class="material-icons">settings</i> Update</a></li>
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
                    <?php if(kenadekha() == false){ ?>

                        <div class="col-md-11 col-sm-11 col-xs-12 col-md-offset-1 rightSideWrapper">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2><i class="material-icons">close</i> Verify Your Purchase Code</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>verify/kenadekha" accept-charset="utf-8">
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



                <?php if($this->session->flashdata('success')){ ?>
                   <div class="col-md-offset-1 col-md-11">
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    </div>
                <?php } else if($this->session->flashdata('error')){ ?>
                   <div class="col-md-offset-1 col-md-11">
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    </div>
                <?php }?>

                <div class="col-md-1 col-xs-12 leftSideMenu">
                    <div class="left_col">
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li><a href="<?php echo base_url(); ?>"><i class="material-icons">home</i> Home </a></li>
                                    <?php if(notAdmin()){ ?>
                                    <li><a href="<?php echo base_url(); ?>pppoe/"><i class="material-icons">computer</i> PPPoE </a></li>
                                    <li><a href="<?php echo base_url(); ?>hotspot/"><i class="material-icons">wifi_tethering</i> Hotspot </a></li>
                                    <li><a href="<?php echo base_url(); ?>user/all"><i class="material-icons">group</i> Users</a></li>
                                    <li><a href="<?php echo base_url(); ?>bill/"><i class="material-icons">attach_money</i> Add Bill/Invoice </a></li>
                                    <li><a href="<?php echo base_url(); ?>bill/browse"><i class="material-icons">search</i> Browse Bills </a></li>
                                    <li><a href="<?php echo base_url(); ?>package/"><i class="material-icons">add_box</i> Add Package </a></li>
                                    <li><a href="<?php echo base_url(); ?>package/all"><i class="material-icons">view_list</i> All Packages </a></li>
                                    <li><a href="<?php echo base_url(); ?>invoice/add"><i class="material-icons">receipt</i> Add Invoice</a></li>
                                    <li><a href="<?php echo base_url(); ?>ticket/all/"><i class="material-icons">receipt</i> All Tickets</a></li>
                                    <li><a href="<?php echo base_url(); ?>invoice/all"><i class="material-icons">receipt</i> Invoices</a></li>
                                    <li><a href="<?php echo base_url(); ?>payments/all"><i class="material-icons">assignment_turned_in</i> Payments</a></li>
                                    <li><a href="<?php echo base_url(); ?>balance/"><i class="material-icons">attach_money</i> Income/Expense</a></li>
                                    <li><a href="<?php echo base_url(); ?>area"><i class="material-icons">my_location</i> Area </a></li>
                                    <li><a href="<?php echo base_url(); ?>staff"><i class="material-icons">perm_identity</i> Staff </a></li>
                                    <li><a href="<?php echo base_url(); ?>import"><i class="material-icons">add</i> Import </a></li>
                                    <li><a href="<?php echo base_url(); ?>communication"><i class="material-icons">sms</i> Communication </a></li>
                                    <li><a href="<?php echo base_url(); ?>settings"><i class="material-icons">settings</i> Settings </a></li>
                                    <li><a href="<?php echo base_url(); ?>logs/"><i class="material-icons">import_contacts</i> Logs </a></li>
                                    <?php }else{ ?>
                                    <li><a href="<?php echo base_url(); ?>ticket/"><i class="material-icons">receipt</i> New Tickets</a></li>
                                    <li><a href="<?php echo base_url(); ?>ticket/all/"><i class="material-icons">receipt</i> All Tickets</a></li>
                                    <li><a href="<?php echo base_url(); ?>user/invoices"><i class="material-icons">receipt</i> Invoices</a></li>
                                    <li><a href="<?php echo base_url(); ?>user/payments"><i class="material-icons">assignment_turned_in</i> Payments</a></li>
                                    <?php } ?>
                                    <li><a href="<?php echo base_url(); ?>login/logout"><i class="material-icons">cancel</i> Logout </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>







            <!-- /top navigation -->
