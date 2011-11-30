<?php
class StoresController extends AppController {

	public $components = array('Cart', 'Paypal');

	public $uses = array('Product');

	public function clear() {
		$this->Session->delete('Cart');
		$this->Session->delete('Paypal');
		$this->redirect('/');
	}

	public function add() {
		if ($this->request->is('post')) {
			$id = $this->request->data['Product']['id'];
			$this->Cart->add($id, 1);
		}
		$this->Session->setFlash('Product has added to cart');
		$this->redirect($this->referer());
	}

	public function update() {
		$this->Cart->update($this->request->data['Product']['id'], 1);
	}

	public function remove($id = null) {
		$this->Cart->remove($id);
		$this->Session->setFlash('Removed');
		$this->redirect(array('action' => 'cart'));
	}


	public function cart() {

		if ($this->request->is('post')) {
			foreach($this->request->data['Product'] as $key => $value) {
				$p = explode('-', $key);
				$this->Cart->add($p[1], $value);
			}
		}
		
		$items = $this->Cart->cart();
		$this->set('items', $items['Products']);
		$this->set('cartTotal', $items['cartTotal']);

		$this->Session->write('Paypal.Payment_Amount', $items['cartTotal']);
	}

	public function step1() {
		$price = $this->Session->read('Paypal.Payment_Amount');
		$this->Paypal->step1($price);
	}

	public function step2() {
		
		$token = $this->request->query['token'];
		debug($token);
		
		$PayerID = $this->request->query['PayerID'];
		debug($PayerID);
		
		$resArray = $this->Paypal->GetShippingDetails($token);
		
		debug($resArray);

		$ack = strtoupper($resArray["ACK"]);
		if($ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") {
			$this->Session->write('Paypal.Customer', $resArray);
		} else {
			$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
			$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
			$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
			$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
			echo "GetExpressCheckoutDetails API call failed. ";
			echo "Detailed Error Message: " . $ErrorLongMsg;
			echo "Short Error Message: " . $ErrorShortMsg;
			echo "Error Code: " . $ErrorCode;
			echo "Error Severity Code: " . $ErrorSeverityCode;
			die();
		}
		
		debug($this->request);
	}



	public function confirm() {
		
		$price = $this->Session->read('Paypal.Payment_Amount');
		
		$resArray = $this->Paypal->ConfirmPayment($price);
		debug($resArray);
		$ack = strtoupper($resArray["ACK"]);
		if($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
			$paypal = $this->Session->read('Paypal');
			debug($paypal);
		}
		
		debug($this->request);
	}

}
