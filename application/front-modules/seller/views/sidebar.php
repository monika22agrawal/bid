<?php
$activeTabs = $this->uri->segment('1');
if(!empty($this->uri->segment('2'))){

  $activeTabs = $this->uri->segment(2);
} 
$Seller = $Property = $SoldPropertyList = '';

switch ($activeTabs) {

    case 'seller':
       $Seller = "active";
    break;

    case 'addProperty':
       $Property = "active";
    break;

    case 'soldPropertyList':
       $SoldPropertyList = "active";
    break;
  
  	default:
    	$Seller = "active";
    break;
}
?>
<div class="userPart">
    <h1>Seller</h1>
    <h2><?php echo !empty($this->session->userdata('name')) ? $this->session->userdata('name') : 'NA';?></h2>
    <p class="para w-color"><?php echo $this->session->userdata('email');?></p>
    <p class="para w-color"><?php echo $this->session->userdata('contactNo');?></p>
    <a href="<?php echo base_url('home/logout');?>" class="btn btn-theme btn-white">Logout</a>
</div>
<div class="acountLink">
	<ul class="list-unstyled">
		<li><a class="<?php echo $Seller;?>" href="<?php echo base_url('seller');?>">Account Setting</a></li>
		<li><a class="<?php echo $Property;?>" href="<?php echo base_url('seller/addProperty');?>">Add Property</a></li>
		<li><a class="<?php echo $SoldPropertyList;?>" href="<?php echo base_url('seller/soldPropertyList');?>">My Sold Property</a></li>
	</ul>
</div>