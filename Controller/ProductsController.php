<?php
class ProductsController extends AppController {

//////////////////////////////////////////////////

	public function index() {
		$products = $this->Product->find('all', array(
		'recursive' => -1,
		'order' => 'RAND()',
		'limit' => 50,
		));
		$this->set(compact('products'));
	}

//////////////////////////////////////////////////

	public function view($id = null) {

		$product = $this->Product->find('first', array(
			'recursive' => -1,
			'conditions' => array('Product.slug' => $id)
		));
		if (empty($product)) {
			$this->redirect(array('action' => 'index'), 301);
		}
		$this->set(compact('product'));

	}

//////////////////////////////////////////////////

}
