<?php
App::uses('AppController', 'Controller');
class ShopController extends AppController {

//////////////////////////////////////////////////

	public $components = array('Cart', 'Paypal');

//////////////////////////////////////////////////

	public $uses = 'Product';

//////////////////////////////////////////////////

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Security->validatePost = false;
	}

//////////////////////////////////////////////////

	public function clear() {
		$this->Session->delete('Shop');
		$this->redirect('/');
	}

//////////////////////////////////////////////////

	public function add() {
		if ($this->request->is('post')) {
			$id = $this->request->data['Product']['id'];
			$this->Cart->add($id, 1);
		}
		$this->Session->setFlash('Product has added to cart');
		$this->redirect($this->referer());
	}

//////////////////////////////////////////////////

	public function update() {
		$this->Cart->update($this->request->data['Product']['id'], 1);
	}

//////////////////////////////////////////////////

	public function remove($id = null) {
		$this->Cart->remove($id);
		$this->Session->setFlash('Removed');
		$this->redirect(array('action' => 'cart'));
	}


//////////////////////////////////////////////////

	public function cartupdate() {
		if ($this->request->is('post')) {
			foreach($this->request->data['Product'] as $key => $value) {
				$p = explode('-', $key);
				$this->Cart->add($p[1], $value);
			}
		}
		$this->redirect(array('action' => 'cart'));
	}

//////////////////////////////////////////////////

	public function cart() {
		$this->helpers[] = 'Google';
		$items = $this->Cart->cart();
		$this->set('items', $items['Products']);
		$this->set('cartTotal', $items['cartTotal']);
	}

//////////////////////////////////////////////////

	public function checkout() {
		if ($this->request->is('post')) {
			$this->loadModel('Order');
			$this->Order->set($this->request->data);
			if($this->Order->validates()) {
				echo 'valid';
				$order = $this->request->data['Order'];
				$this->Session->write('Shop.Order', $order);
				$this->redirect(array('action' => 'confirm'));
			}
		}
	}

//////////////////////////////////////////////////

	public function step1() {
		$price = $this->Session->read('Shop.Cart.property.cartTotal');
		$this->Paypal->step1($price);
	}

//////////////////////////////////////////////////

	public function step2() {

		$token = $this->request->query['token'];
		$paypal = $this->Paypal->GetShippingDetails($token);

		$ack = strtoupper($paypal["ACK"]);
		if($ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") {
			$this->Session->write('Shop.Paypal.Details', $paypal);
			$this->redirect(array('action' => 'review'));
		} else {
			$ErrorCode = urldecode($paypal["L_ERRORCODE0"]);
			$ErrorShortMsg = urldecode($paypal["L_SHORTMESSAGE0"]);
			$ErrorLongMsg = urldecode($paypal["L_LONGMESSAGE0"]);
			$ErrorSeverityCode = urldecode($paypal["L_SEVERITYCODE0"]);
			echo "GetExpressCheckoutDetails API call failed. ";
			echo "Detailed Error Message: " . $ErrorLongMsg;
			echo "Short Error Message: " . $ErrorShortMsg;
			echo "Error Code: " . $ErrorCode;
			echo "Error Severity Code: " . $ErrorSeverityCode;
			die();
		}

	}

//////////////////////////////////////////////////

	public function review() {
		$shop = $this->Session->read('Shop.Cart');
		$this->set(compact('shop'));
	}

//////////////////////////////////////////////////

	public function confirm() {

		$price = $this->Session->read('Shop.Paypal.Payment_Amount');
		$shop = $this->Session->read('Shop');

		if ($this->request->is('post')) {
			$this->loadModel('Order');
			
			$i = 0;
			foreach($shop['Cart']['items'] as $c) {
				$o['OrderItem'][$i]['quantity'] = $c['quantity'];
				$o['OrderItem'][$i]['price'] = $c['subtotal'];
				$i++;
			}	
			
			$o['Order'] = $shop['Order'];
			$o['Order']['total'] = $shop['Cart']['property']['cartTotal'];
			
			$this->Order->saveAll($o);
		}

		$this->set(compact('shop'));
		//$resArray = $this->Paypal->ConfirmPayment($price);
		//debug($resArray);
		//$ack = strtoupper($resArray["ACK"]);
		//if($ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING") {
		//	$paypal = $this->Session->read('Paypal');
		//	debug($paypal);
		//}

		// debug($this->request);
	}

//////////////////////////////////////////////////

}