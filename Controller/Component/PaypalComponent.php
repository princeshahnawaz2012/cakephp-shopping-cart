<?php
class PaypalComponent extends Component {

//////////////////////////////////////////////////

   	public $components = array('Session');

//////////////////////////////////////////////////

    public $controller = null;

//////////////////////////////////////////////////

	public $API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
	public $PAYPAL_URL = "https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=";
		
//////////////////////////////////////////////////

    public function initialize(&$controller) {

		$this->API_UserName = API_USERNAME; 
		$this->API_Password = API_PASSWORD;
		$this->API_Signature = API_SIGNATURE;
		$this->version = 64;
		$this->SandboxFlag = true;
		$this->returnURL = WEBSITE . '/stores/step2';
		$this->cancelURL = WEBSITE . '/stores/cart';
		$this->paymentType = 'Sale';
		$this->currencyCodeType = 'USD';
		$this->sBNCode = 'PP-ECWizard';
		
	}

//////////////////////////////////////////////////

	public function startup(&$controller)  {
		$this->controller =& $controller;
	}

//////////////////////////////////////////////////

	public function step1($paymentAmount = 0) {
		$resArray = $this->CallShortcutExpressCheckout($paymentAmount);
		$ack = strtoupper($resArray["ACK"]);
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING") {
			$this->controller->redirect($this->PAYPAL_URL . $resArray["TOKEN"]);
		}
	}
	
//////////////////////////////////////////////////

	public function CallShortcutExpressCheckout($paymentAmount) {
		$nvpstr = "&PAYMENTREQUEST_0_AMT=". $paymentAmount;
		$nvpstr .= "&PAYMENTREQUEST_0_PAYMENTACTION=" . $this->paymentType;
		$nvpstr .= "&RETURNURL=" . $this->returnURL;
		$nvpstr .= "&CANCELURL=" . $this->cancelURL;
		$nvpstr .= "&PAYMENTREQUEST_0_CURRENCYCODE=" . $this->currencyCodeType;
		$this->Session->write('Shop.Paypal.currencyCodeType', $this->currencyCodeType);    
		$this->Session->write('Shop.Paypal.PaymentType', $this->paymentType);    
	    $resArray = $this->hash_call("SetExpressCheckout", $nvpstr);
		$ack = strtoupper($resArray["ACK"]);
		if($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
			$token = urldecode($resArray["TOKEN"]);
			$this->Session->write('Shop.Paypal.TOKEN', $token);    
		}
	    return $resArray;
	}

//////////////////////////////////////////////////

	public function GetShippingDetails($token) {
	    $resArray = $this->hash_call('GetExpressCheckoutDetails', '&TOKEN=' . $token);
	    $ack = strtoupper($resArray['ACK']);
		if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {	
			$this->Session->write('Shop.Paypal.payer_id', $resArray['PAYERID']);    
		} 
		return $resArray;
	}

//////////////////////////////////////////////////

	public function ConfirmPayment($FinalPaymentAmt) {
		$paypal = $this->Session->read('Shop.Paypal');
		$token 				= urlencode($paypal['TOKEN']);
		$paymentType 		= urlencode($paypal['PaymentType']);
		$currencyCodeType 	= urlencode($paypal['currencyCodeType']);
		$payerID 			= urlencode($paypal['payer_id']);
		$serverName 		= urlencode($_SERVER['SERVER_NAME']);
		$nvpstr  = '&TOKEN=' . $token . '&PAYERID=' . $payerID . '&PAYMENTREQUEST_0_PAYMENTACTION=' . $paymentType . '&PAYMENTREQUEST_0_AMT=' . $FinalPaymentAmt;
		$nvpstr .= '&PAYMENTREQUEST_0_CURRENCYCODE=' . $currencyCodeType . '&IPADDRESS=' . $serverName; 

		debug($nvpstr);

		$resArray = $this->hash_call("DoExpressCheckoutPayment", $nvpstr);
		
		debug($resArray);
		
		$ack = strtoupper($resArray["ACK"]);
		return $resArray;
	}

//////////////////////////////////////////////////

	public function hash_call($methodName, $nvpStr) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		$nvpreq  = "METHOD=" . urlencode($methodName) . "&VERSION=" . urlencode($this->version) . "&PWD=" . urlencode($this->API_Password);
		$nvpreq .= "&USER=" . urlencode($this->API_UserName) . "&SIGNATURE=" . urlencode($this->API_Signature) . $nvpStr . "&BUTTONSOURCE=" . urlencode($this->sBNCode);

		debug($nvpreq);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		$response = curl_exec($ch);
		$nvpResArray = $this->deformatNVP($response);
		$nvpReqArray = $this->deformatNVP($nvpreq);
		if (curl_errno($ch)) {
			$this->Session->write('Shop.Paypal.curl_error_no', curl_errno($ch));    
			$this->Session->write('Shop.Paypal.curl_error_msg', curl_error($ch));    
		} else {
		  	curl_close($ch);
		}
		return $nvpResArray;
	}
	
//////////////////////////////////////////////////

	public function deformatNVP($nvpstr) {
		$intial = 0;
	 	$nvpArray = array();
		while(strlen($nvpstr)) {
			$keypos= strpos($nvpstr, '=');
			$valuepos = strpos($nvpstr, '&') ? strpos($nvpstr, '&') : strlen($nvpstr);
			$keyval = substr($nvpstr, $intial, $keypos);
			$valval = substr($nvpstr, $keypos + 1, $valuepos - $keypos - 1);
			$nvpArray[urldecode($keyval)] = urldecode($valval);
			$nvpstr = substr($nvpstr, $valuepos + 1, strlen($nvpstr));
	     }
		return $nvpArray;
	}

//////////////////////////////////////////////////

}