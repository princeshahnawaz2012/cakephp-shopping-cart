<?php
App::uses('AppModel', 'Model');
class User extends AppModel {

    public function beforeSave($options = array()) {
        $password_unhashed = $this->data[$this->name]['password'];
        $this->data[$this->name]['password'] = AuthComponent::password($password_unhashed);
        return true;
    }

}
