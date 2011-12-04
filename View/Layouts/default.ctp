<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title_for_layout; ?></title>
<?php echo $this->Html->css(array('css.css', '960_24_col.css')); ?>
<?php echo $this->Html->script(array('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js')); ?>
<?php echo $scripts_for_layout; ?>
</head>
<body>
<?php echo $this->Session->flash(); ?>
<?php echo $content_for_layout; ?>
<?php echo $this->element('sql_dump'); ?>
<br /><br />
<div id="top">
	<div id="menu">
		<h2>AKND</h2>
		<?php echo $this->Html->link('Home', array('controller' => 'products', 'action' => 'view')); ?> &nbsp;
		<?php echo $this->Html->link('Cart', array('controller' => 'stores', 'action' => 'cart')); ?>
	</div>
</div>

<div id+"footer">&copy; <?php echo date('Y'); ?> <?php echo env('HTTP_HOST'); ?></div>

</body>
</html>
