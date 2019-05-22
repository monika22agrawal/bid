<?php
date_default_timezone_set('Australia/Sydney');  
$activeTabs = $this->uri->segment('1');
if(!empty($this->uri->segment('2'))){

  $activeTabs = $this->uri->segment(2);
} 
$dashboard = $title = $allSeller = $allBuyer  =  $allProperty  = $AllLoan  = $AllPayment = '';

switch ($activeTabs) {
    case 'dashboard':
       $dashboard = "active";
       $title = "Dashboard";
    break;

    case 'allSeller':
       $allSeller = "active";
       $title = "Seller List";
    break; 

    case 'allBuyer':
       $allBuyer = "active";
       $title = "Buyer List";
    break;

    case 'allProperty':
       $allProperty = "active";
       $title = "All Property";
    break;

    case 'propertyDetail':
       $allProperty = "active";
       $title = "Property Detail";
    break;

    case 'allPropertyType':
       $allProperty = "active";
       $title = "All Property Type";
    break;

    case 'addPropertyType':
       $allProperty = "active";
       $title = "Add Property Type";
    break;

    case 'allLoan':
       $AllLoan = "active";
       $title = "All Loan List";
    break;

    case 'allPayment':
       $AllPayment = "active";
       $title = "All Payment List";
    break;

    default:
        $dashboard = "active";
        $title = "Dashboard";
    break;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | <?php echo $title;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/AdminLTE.min.css">
    <!-- Material Design -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/ripples.min.css">
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/MaterialAdminLTE.min.css">
    <!-- MaterialAdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/css/skins/all-md-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url().ADMIN_THEME;?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="shortcut icon" href="<?php echo base_url().ADMIN_THEME;?>asset/dist/img/logo.png">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.2.3 -->
    <!--<script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/jQuery/jquery-2.2.3.min.js"></script>-->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/jquery.min.js" type="text/javascript"></script> 
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/jquery.validate.min.js"></script>
</head>
<body class="hold-transition sidebar-mini wysihtml5-supported skin-blue-light">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url('dashboard');?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img height=30; width=50; src="<?php echo base_url().ADMIN_THEME;?>asset/dist/img/logo.png"/></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img height=30; width=50; src="<?php echo base_url().ADMIN_THEME;?>asset/dist/img/logo.png"/><b>Bid Home</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url().ADMIN_THEME;?>asset/dist/img/boss-512.png" class="user-image" alt="User Image">
                                <span class="hidden-xs">Admin</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo base_url().ADMIN_THEME;?>asset/dist/img/boss-512.png" class="img-circle" alt="User Image">
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!-- <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div> -->
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('dashboard/logout');  ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url().ADMIN_THEME;?>asset/dist/img/boss-512.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Admin</p>
                        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <!-- <li class="header">MAIN MENU</li> -->
                    <li class="<?php echo $dashboard;?>"><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                    <li class="treeview <?php echo $allSeller;?>">
                        <a href="#">
                            <i class="fa fa-user"></i>
                        <span>Sellers</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('seller/allSeller');?>"><i class="fa fa-circle-o text-red"></i> All Seller</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $allBuyer;?>">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                        <span>Buyers</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('buyer/allBuyer');?>"><i class="fa fa-circle-o text-red"></i> All Buyer</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $allProperty;?>">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                        <span>Property</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('property/allProperty');?>"><i class="fa fa-circle-o text-red"></i> All Property</a></li>
                            <li><a href="<?php echo base_url('property/allPropertyType');?>"><i class="fa fa-circle-o text-red"></i> All Property Type</a></li>
                            <li><a href="<?php echo base_url('property/addPropertyType');?>"><i class="fa fa-circle-o text-red"></i> Add New Property Type</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $AllLoan;?>">
                        <a href="#">
                            <i class="fa fa-user"></i>
                        <span>Home Loan</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('loan/allLoan');?>"><i class="fa fa-circle-o text-red"></i> All Home Loan User</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php echo $AllPayment;?>">
                        <a href="#">
                            <i class="fa fa-cc-stripe"></i>
                        <span>Payment Detail</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('payment/allPayment');?>"><i class="fa fa-circle-o text-red"></i> All Payment List</a></li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <?php echo $template['body']; ?>
        <footer class="main-footer">
            <!-- <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.8
            </div> -->
            <strong>Copyright &copy; <?php echo date('Y');?></strong> All rights
            reserved.
        </footer>
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/bootstrap/js/bootstrap.min.js"></script>
    <!-- Material Design -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/material.min.js"></script>
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/ripples.min.js"></script>
    <script>
        $.material.init();
    </script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().ADMIN_THEME;?>asset/dist/js/demo.js"></script>
</body>
</html>
