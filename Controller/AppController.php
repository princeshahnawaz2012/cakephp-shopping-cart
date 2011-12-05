<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {

	public $components = array(
		'Session',
		'DebugKit.Toolbar',
		'Auth',
	);

	public function beforeFilter() {

		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
		$this->Auth->loginRedirect = array('controller' => 'orders', 'action' => 'index', 'admin' => true);
		$this->Auth->logoutRedirect = array('controller' => 'products', 'action' => 'index', 'admin' => false);

		$this->Auth->authenticate = array(
			AuthComponent::ALL => array(
				'userModel' => 'User',
				'fields' => array(
					'username' => 'username',
					'password' => 'password'
				),
				'scope' => array(
					'User.is_active' => '1'
				)
			), 'Form'
		);

		if(isset($this->request->params['admin']) && ($this->request->params['prefix'] == 'admin')) {
			$this->layout = 'admin';
		} else {
			$this->Auth->allow('*');
		}

	}

}
