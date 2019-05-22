<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include APPPATH.'third_party/stripe/vendor/autoload.php';
class Stripe{

	public function __construct () {
		$this->ci =& get_instance();
		$this->ci->config->load('mylib');
		$secret_key = $this->ci->config->item('secret_key');
		$publishable_key = $this->ci->config->item('publishable_key');
		
	}
	 

	function addCardAccount($name,$number,$exp_month,$exp_year,$cvv){
		
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
		
		try{

			$result = Stripe\Token::create(
			array(
			"card" => array(
				"number" => $number,
				"exp_month" => $exp_month,
				"exp_year" => $exp_year,
				"cvc" => $cvv
				) 
			)
			); 
			
			if(isset($result['id']) && !empty($result['id'])){
				return array('status'=>true,'message'=>'ok','data'=>$result['id']);
			}
		}catch(Exception $e){

			$message = $e->getMessage();
			return array('status'=>false,'message'=>$message,'data'=>'');
		}      
	}
	
    function save_card_id($token = ''){
		//print_r($token);die;
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
		
		try{
			$customer = Stripe\Customer::create(array(
			  "email" => 'monika.mindiii@gmail.com', 
			  "source" => $token,
			));
		
			if(isset($customer->id) && !empty($customer->id)){
			
				return array('status'=>true,'message'=>'ok','data'=>$customer->id);
			}

		}catch(Exception $e){
			$message = $e->getMessage();
			return array('status'=>false,'message'=>$message,'data'=>'');
		}  
	}
	
	function pay_by_card_id($payment,$custId){
		
		$paymentt = round($payment,2);
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
        try{

        	$charge = Stripe\Charge::create(array(
		  	"amount" => $paymentt *100, //convert into cent
		  	"currency" => 'USD',
		  	"customer" => $custId
			));
	
			if(isset($charge->balance_transaction) && !empty($charge->balance_transaction)){
				
				return array('status'=>true,'message'=>'ok','data'=>$charge);
			}
        }catch(Exception $e){

        	$message = $e->getMessage();
			return array('status'=>false,'message'=>$message,'data'=>'');
		}  
		
	}

	function refundToCard($chargeId){

		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
        try{

        	$refund = \Stripe\Refund::create(array(
			  "charge" =>$chargeId 
			));
			if(isset($refund ->id) && !empty($refund ->id)){

				return array('status'=>true,'message'=>'ok','data'=>$refund ->id);
			}
        }catch(Exception $e){

        	$message = $e->getMessage();
			return array('status'=>false,'message'=>$message,'data'=>'');
		}  
		
	}

	 
}
