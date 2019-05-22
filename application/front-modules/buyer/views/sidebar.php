<?php
$activeTabs = $this->uri->segment('1');
if(!empty($this->uri->segment('2'))){

  $activeTabs = $this->uri->segment(2);
} 
$Buyer = $Cart = '';

switch ($activeTabs) {

    case 'seller':
       $Buyer = "active";
    break;

    case 'shoppingCart':
       $Cart = "active";
    break;
  
  	default:
    	$Buyer = "active";
    break;
}
?>
<div class="userPart">
    <h1>Buyer</h1>
    <h2><?php echo !empty($this->session->userdata('name')) ? $this->session->userdata('name') : 'NA';?></h2>
    <p class="para w-color"><?php echo $this->session->userdata('email');?></p>
    <p class="para w-color"><?php echo $this->session->userdata('contactNo');?></p>
    <a href="<?php echo base_url('home/logout');?>" class="btn btn-theme btn-white">Logout</a>
</div>
<div class="acountLink">
	<ul class="list-unstyled">
		<li><a class="<?php echo $Buyer;?>" href="<?php echo base_url('buyer');?>">Account Setting</a></li>
		<li><a class="<?php echo $Cart;?>" href="<?php echo base_url('buyer/shoppingCart');?>">Shopping Cart</a></li>
	</ul>
</div>