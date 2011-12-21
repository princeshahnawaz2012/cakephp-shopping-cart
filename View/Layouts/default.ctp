<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title_for_layout; ?></title>
<?php echo $this->Html->css(array('reset.css', 'css.css', '960_24_col.css')); ?>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<?php echo $this->Html->script(array('js.js', 'search.js')); ?>
<?php echo $scripts_for_layout; ?>
</head>
<body>
<div class="container_24 body">
<?php echo $this->Session->flash(); ?>
<?php echo $content_for_layout; ?>
<?php echo $this->element('sql_dump'); ?>
<br /><br />
<div id="top">
	<div id="menu">
		<h2>AKND</h2>
		<?php echo $this->Html->link('Home', array('controller' => 'products', 'action' => 'view')); ?> &nbsp;
		<?php echo $this->Html->link('Shopping Cart', array('controller' => 'shop', 'action' => 'cart')); ?>
	</div>
</div>
<div id="search">
	<?php echo $this->Form->create('Product', array('type' => 'GET', 'url' => array('controller' => 'products', 'action' => 'search'))); ?>
	<?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'autocomplete' => 'off')); ?>
	<?php echo $this->Form->submit('Search', array('div' => false, 'class' => 'submit')); ?>
	<?php echo $this->Form->end(); ?>
</div>
<div id="footer">
<?php echo $this->Html->link($this->Html->image('cake.power.gif', array('alt' => 'CakePHP', 'border' => '0')), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)); ?>
<br />
<br />
&copy;
<?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?>
</div>
</div>
</body>
</html>
