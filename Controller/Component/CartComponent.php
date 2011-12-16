<?php
class CartComponent extends Component {

//////////////////////////////////////////////////

   	public $components = array('Session');

//////////////////////////////////////////////////

    public $controller = null;

//////////////////////////////////////////////////

	public function startup(&$controller) {
		$this->controller =& $controller;
	}

//////////////////////////////////////////////////

	public $maxQuantity = 20;

//////////////////////////////////////////////////


    public function add($id, $quantity = 1) {
	
		if(!is_numeric($quantity)) {
			$quantity = 1;
		}
		$quantity = abs($quantity);
		if($quantity > $this->maxQuantity) {
			$quantity = $this->maxQuantity;
		}
		if($quantity == 0) {
			$this->remove($id);
			return;
		}
	
		$product = $this->controller->Product->find('first', array(
			'recursive' => -1,
			'conditions' => array(
				'Product.id' => $id
			)
		));
		if(empty($product)) {
			return false;
		}
		$data['quantity'] = $quantity;
		$data['subtotal'] = sprintf('%01.2f', $product['Product']['price'] * $quantity);
		
		$data['Product'] = $product['Product'];
		$this->Session->write('Shop.Cart.items.' . $id, $data);    

		$cart = $this->cart();
		$d['cartTotal'] = $cart['cartTotal'];
		$d['cartQuantity'] = $cart['cartQuantity'];
		$this->Session->write('Shop.Cart.property', $d);    
		
		return $product;
	}

//////////////////////////////////////////////////

    public function remove($id) {
		$this->Session->delete('Shop.Cart.items.' . $id);
		$cart = $this->cart();
		$d['cartTotal'] = $cart['cartTotal'];
		$d['cartQuantity'] = $cart['cartQuantity'];
		$this->Session->write('Shop.Cart.property', $d);
	}

//////////////////////////////////////////////////

	public function cart() {
		$cart = $this->Session->read('Shop.Cart');
		$cartTotal = 0;
		$cartQuantity = 0;
		if (count($cart['items']) > 0) {
			foreach ($cart['items'] as $item) {
				$cartTotal += $item['subtotal'];
				$cartQuantity += $item['quantity'];
				
			}
			return array(
				'Products' => $cart['items'],
				'cartTotal' => sprintf('%01.2f', $cartTotal),
				'cartQuantity' => $cartQuantity,
			);
		}
		else {
			return null;
		}
	}
	
//////////////////////////////////////////////////

}