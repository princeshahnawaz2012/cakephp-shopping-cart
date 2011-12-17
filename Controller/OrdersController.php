<?php
App::uses('AppController', 'Controller');
class OrdersController extends AppController {

	public function admin_index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

	public function admin_view($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$order = $this->Order->find('first', array(
			'recursive' => 1,
			'conditions' => array('Order.id' => $id)
		));
		$this->set(compact('order'));
	}

	public function admin_edit($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Order->read(null, $id);
		}
	}

	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->Order->delete()) {
			$this->Session->setFlash(__('Order deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
