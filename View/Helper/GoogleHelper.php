<?php
App::uses('AppHelper', 'View/Helper');

class GoogleHelper extends AppHelper {

	public $xml;

	public function signature() {
		$signature = base64_encode(hash_hmac('sha1', $this->xml, GOOGLE_CHECKOUT_MERCHANT_KEY, true));
		return $signature;
	}

	public function cart($items) {
		$xml = '<checkout-shopping-cart xmlns="http://checkout.google.com/schema/2"><shopping-cart><items>';
		foreach($items as $item) {
			$xml .= '<item>
			<item-name>' . $item['Product']['name'] . '</item-name>
			<item-description>' . $item['Product']['name'] . '</item-description>
			<unit-price currency="USD">' . $item['Product']['price'] . '</unit-price>
			<quantity>' . $item['quantity'] . '</quantity>
			</item>';
		};
		$xml .= '</items></shopping-cart></checkout-shopping-cart>';
		$this->xml = $xml;
		$cart = base64_encode($xml);
		return $cart;
	}

}
