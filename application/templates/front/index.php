<?php
date_default_timezone_set('Australia/Sydney');
$activeTabs = $this->uri->segment('1');
if(!empty($this->uri->segment('2'))){

  $activeTabs = $this->uri->segment('2');
} 
$title = $Home = $AboutUs  = $ContactUs = $MyProfile = $SignUp = $Login = $SellerHome = $BuyerHome = $AddProperty = $Loan = '';

switch ($activeTabs) {

    case 'home':
       $Home = "active";
       $title = "Home";
    break;

    case 'loan':
       $Loan = "active";
       $title = "Home Loan";
    break;

    case 'aboutUs':
       $AboutUs = "active";
       $title = "About Us";
    break;

    case 'contactUs':
        $ContactUs = "active";
        $title = "Contact Us";
    break;

    case 'signUp':
       $SignUp = "active";
       $title = "Sign Up";
    break; 

    case 'login':
       $Login = "active";
       $title = "Login";
    break;

    case 'buyerHome':
       $BuyerHome = "active";
       $title = "Buyer Home";
    break; 

    case 'buyer':
       $MyProfile = "active";
       $title = "My Profile";
    break; 

    case 'sellerHome':
       $SellerHome = "active";
       $title = "Seller Home";
    break; 

    case 'seller':
       $MyProfile = "active";
       $title = "My Profile";
    break;

    case 'addProperty':
       $MyProfile = "active";
       $title = "Add Property";
    break;

    case 'shoppingCart':
       $MyProfile = "active";
       $title = "Add Property";
    break; 
  
    default:
        $Home = "active";
        $title = "Home";
    break;
    
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bid Home | <?php echo $title;?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url().FRONT_THEME;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/jquery-ui.min.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/font.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/bootstrap-datetimepicker-standalone.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/form-wizard-blue.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url().FRONT_THEME;?>css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url().FRONT_THEME;?>img/logo.png">

    <link rel="stylesheet" href="<?php echo base_url().FRONT_THEME;?>css/sweetalert.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url().FRONT_THEME;?>js/jquery.min.js" type="text/javascript"></script> 
    <script src="<?php echo base_url().FRONT_THEME;?>js/jquery.validate.min.js"></script>
    
    <script src="<?php echo base_url().FRONT_THEME;?>js/sweetalert.js"></script>

  </head>
<body>

    <header class="MainHeader <?php echo (($this->uri->segment('1') == 'home' || empty($this->uri->segment('1'))) && $this->uri->segment('2') == '') ? '' : 'fixedHeader'; ?>">
        <div class="topBar"></div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">

                <?php if($this->session->userdata('front_login') == true && $this->session->userdata('id') != ''){?>                        

                    <?php if($this->session->userdata('userType') == '1'){?>
                        <a class="navbar-brand" href="<?php echo base_url('seller/sellerHome');?>">
                            <img class="lg1" src="<?php echo base_url().FRONT_THEME;?>img/logo.png">
                            <img class="lg2" src="<?php echo base_url().FRONT_THEME;?>img/logo-w.png">
                        </a>
                        
                    <?php } elseif($this->session->userdata('userType') == '2'){?>
                        <a class="navbar-brand" href="<?php echo base_url('buyer/buyerHome');?>">
                            <img class="lg1" src="<?php echo base_url().FRONT_THEME;?>img/logo.png">
                            <img class="lg2" src="<?php echo base_url().FRONT_THEME;?>img/logo-w.png">
                        </a>
                        
                    <?php } ?>                            
                    
                <?php } else {  ?>
                    <a class="navbar-brand" href="<?php echo base_url();?>">
                        <img class="lg1" src="<?php echo base_url().FRONT_THEME;?>img/logo.png">
                        <img class="lg2" src="<?php echo base_url().FRONT_THEME;?>img/logo-w.png">
                    </a>
                <?php } ?>    
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                    <?php if($this->session->userdata('front_login') == true && $this->session->userdata('id') != ''){?>                        

                            <?php if($this->session->userdata('userType') == '1'){?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $SellerHome;?>" href="<?php echo base_url('seller/sellerHome');?>">Home</a>
                                </li>
                            <?php } elseif($this->session->userdata('userType') == '2'){?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $BuyerHome;?>" href="<?php echo base_url('buyer/buyerHome');?>">Home</a>
                                </li>
                            <?php } ?>                            
                            
                    <?php } else { ?>

                            <li class="nav-item">
                                <a class="nav-link <?php echo $Home;?>" href="<?php echo base_url();?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $Loan;?>" href="<?php echo base_url('loan');?>">Home Loan</a>
                            </li>
                    <?php } ?>
                            <li class="nav-item ScrollMenu">
                                <a class="nav-link <?php echo $AboutUs;?>" href="#AboutSec">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $ContactUs;?>" href="javascript:void(0);">Contact Us</a>
                            </li>
                        </ul>                    
                    
                    <?php if($this->session->userdata('front_login') == true && $this->session->userdata('id') != ''){?>
                        <ul class="navbar-nav loginLink">
                            <?php if($this->session->userdata('userType') == '1'){?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $MyProfile;?>" href="<?php echo base_url('seller');?>"><i class="fa fa-user"></i>My Profile</a>
                                </li>
                            <?php } elseif($this->session->userdata('userType') == '2'){?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo $MyProfile;?>" href="<?php echo base_url('buyer');?>"><i class="fa fa-user"></i>My Profile</a>
                                </li>
                            <?php } ?>                            
                        </ul>
                    <?php } else {?>

                        <ul class="navbar-nav loginLink">
                            <li class="nav-item">
                                <a class="nav-link <?php echo $Login;?>" href="<?php echo base_url('login');?>"><i class="fa fa-user"></i> Login/Register</a>
                            </li>
                        </ul>
                        
                    <?php } ?>
                </div>
            </div>
        </nav>
    </header>
    <?php echo $template['body']; ?>
    <footer class="MainFooter">
        <div class="Footer sec-pad">
            <div class="container">
                <div class="FtCnt">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="at-footer-about-col at-col-default-mar">
                                <div class="at-footer-logo">
                                    <img src="<?php echo base_url().FRONT_THEME;?>img/logo-w.png" alt="">
                                </div>
                                <hr>
                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p> -->
                                <div class="at-social text-left">
                                    <a href="javascript:void(0);"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0);"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0);"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0);"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0);"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 offset-lg-1 col-md-3 offset-md-1 col-sm-12">
                            <div class="at-footer-link-col at-col-default-mar">
                                <div class="ftHead">
                                <h4>Quick links</h4>
                                <div class="at-heading-under-line">
                                    <div class="at-heading-inside-line"></div>
                                </div>
                                </div>
                                <ul>
                                    <?php if($this->session->userdata('front_login') == true && $this->session->userdata('id') != ''){?>                        

                                    <?php if($this->session->userdata('userType') == '1'){?>
                                        <li><a href="<?php echo base_url('seller/sellerHome');?>"><i class="fa fa-caret-right"></i> Home</a></li>
                        
                                    <?php } elseif($this->session->userdata('userType') == '2'){?>
                                        <li><a href="<?php echo base_url('seller/sellerHome');?>"><i class="fa fa-caret-right"></i> Home</a></li>
                        
                                    <?php } ?>                            
                    
                                    <?php } else {  ?>
                                        <li><a href="<?php echo base_url();?>"><i class="fa fa-caret-right"></i> Home</a></li>
                                    <?php } ?>

                                    <li><a href="<?php echo base_url('buyer/propertyList');?>"><i class="fa fa-caret-right"></i> properties</a></li>

                                    <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> About Us</a></li>                                    
                                    <li><a href="javascript:void(0);"><i class="fa fa-caret-right"></i> Contact Us</a></li>

                                    <li><a href="<?php echo base_url('loan');?>"><i class="fa fa-caret-right"></i> Home Loan</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="at-footer-Tag-col at-col-default-mar">
                                <div class="ftHead">
                                <h4>Contact Us</h4>
                                <div class="at-heading-under-line">
                                    <div class="at-heading-inside-line"></div>
                                </div>
                                </div>
                                <div class="at-tag-group clearfix">
                                    <address>
                                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>Suite 2.00, 29-31 Lexington Drive Bella Vista NSW 2153 Australia </p>
                                        <p><i aria-hidden="true" class="fa fa-phone"></i>02 8046 4230</p>
                                       <!--  <p><i aria-hidden="true" class="fa fa-fax"></i>123-456-789</p>
                                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:info@americanrealty.com">info@americanrealty.com</a></p> -->
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>Copyright <?php echo date('Y');?> &copy; Bid Home | All Rights Reserved. Privacy policy.Terms and Conditions.</p>
        </div>
    </footer>

    <!-- Modal -->
  <div class="modal fade" id="plan" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title">To Access Website</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
        <div class="modal-body">
            <center><img height="100" width="100" src="<?php echo base_url().FRONT_THEME;?>img/logo.png"></center>
          <h6>Currently your identity proof is not approved by admin,for approving or accessing website you have to contact to admin.</h6>
        </div>
        <div class="modal-footer">
          <a href="<?php echo base_url('home/logout');?>" class="btn btn-secondary" >OK</a>
        </div>
      </div>
      
    </div>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url().FRONT_THEME;?>js/popper.min.js"></script>
    <script src="<?php echo base_url().FRONT_THEME;?>js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment-with-locales.min.js"></script>

    <script src="<?php echo base_url().FRONT_THEME;?>js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url().FRONT_THEME;?>js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url().FRONT_THEME;?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url().FRONT_THEME;?>js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url().FRONT_THEME;?>js/form-wizard.js"></script>
    <script src="<?php echo base_url().FRONT_THEME;?>js/custom.js"></script>

    <?php //if($this->session->userdata('status') == 0 && $this->session->userdata('id') != '' && $this->session->userdata('userType') == '2'){?>
       <!-- <script type="text/javascript">
            getPlan();
            function getPlan(){
                $("#plan").modal({backdrop: 'static', keyboard: false});
            }
        </script>-->
    <?php //}?>

    <?php //if($this->session->userdata('status') == 0 && $this->session->userdata('id') != '' && $this->session->userdata('userType') == '1'){?>
       <!-- <script type="text/javascript">
            getPlan();
            function getPlan(){
                $("#plan").modal({backdrop: 'static', keyboard: false});
            }
        </script>-->
    <?php //}?>

    <script type="text/javascript">

        window.setTimeout(function() {
            $(".alert-danger").fadeTo(5000, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);

        window.setTimeout(function() {
            $(".alert-success").fadeTo(5000, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 5000);
        
    </script>
    <?php if($this->session->userdata('id') != ''){?>
        <script type="text/javascript">
            //setInterval(function(){ check();}, 5000);
            check();
            function check()
            {
                var id="<?php echo $this->session->userdata('id');?>";
                $.ajax({
                    url: '<?php echo base_url(); ?>home/checkApproval/',
                    type: "POST",             
                    cache: false,
                    data:{id:id},
                                    
                    success: function(data){
                        //alert(data);
                        if(data == 1 ){
                            $("#plan").modal({backdrop: 'static', keyboard: false});
                        }
                    }
                });
                return false;
            }
        </script>
    <?php } ?>
    </body>
</html>