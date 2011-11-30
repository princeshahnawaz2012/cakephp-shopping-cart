<h1>Login</h1>
<br />
<?php echo $this->Form->create('User', array('action' => 'login')); ?>
<?php echo $this->Form->input('username'); ?>
<br />
<?php echo $this->Form->input('password'); ?>
<br />
<?php echo $this->Form->end('Login'); ?>
<br />
