<?php echo $this->set('title_for_layout', $product['Product']['name']); ?>

<h1><?php echo $product['Product']['name']; ?></h1>

<?php echo $this->Html->Image('/images/' . $product['Product']['image'], array('width' => 150, 'height' => 150, 'alt' => $product['Product']['name'], 'class' => 'image')); ?>

<br />

$ <?php echo $product['Product']['price']; ?>

<br />
<br />

<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'stores', 'action' => 'add'))); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
<?php echo $this->Form->button('Add to Cart'); ?>
<?php echo $this->Form->end(); ?>

<br />

<?php echo $product['Product']['description']; ?>

<br />
<br />
<br />
