<?php echo $this->set('title_for_layout', 'Online Shop'); ?>

<div class="grid_24">

<h1>Online Shop</h1>

<?php
$i = 0;
foreach ($products as $product):
$i++;
?>
<div class="grid_5">
<?php echo $this->Html->image('/images/' . $product['Product']['image'], array('url' => array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug']), 'alt' => $product['Product']['name'], 'width' => 150, 'height' => 150, 'class' => 'image')); ?>
<br />
<?php echo $this->Html->link($product['Product']['name'], array('controller' => 'products', 'action' => 'view', 'slug' => $product['Product']['slug'])); ?>
<br />
$<?php echo $product['Product']['price']; ?>
<br />
<?php echo $this->Form->create(NULL, array('url' => array('controller' => 'shop', 'action' => 'add'))); ?>
<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $product['Product']['id'])); ?>
<?php echo $this->Form->button('Add to Cart');?>
<?php echo $this->Form->end();?>
<br />
<br />
</div>
<?php
if (($i % 4) == 0) { echo "\n<div class=\"clear\"></div>\n\n";}
endforeach;
?>

<br />
<br />

</div>
<div class="clear"></div>


<div class="grid_24">
	
<?php echo $this->Paginator->counter(array('format' => 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')); ?>
<br />
<?php echo $this->Paginator->prev('< previous', array(), null, array('class' => 'prev disabled')); ?>&nbsp;
<?php echo $this->Paginator->numbers(array('separator' => ' | ')); ?>&nbsp;
<?php echo $this->Paginator->next('next >', array(), null, array('class' => 'next disabled')); ?>&nbsp;

</div>
<div class="clear"></div>
