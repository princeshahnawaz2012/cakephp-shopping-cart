<?php if($ajax != 1): ?>
<div class="grid_24">
<h1>Search</h1>
<br />
<br />
<?php echo $this->Form->create('Product', array('type' => 'GET')); ?>
<?php echo $this->Form->input('search', array('label' => false, 'div' => false, 'autocomplete' => 'off', 'value' => $search)); ?>
<?php echo $this->Form->button('Search', array('div' => false, 'class' => 'submit')); ?>
<?php echo $this->Form->end(); ?>
<br />
</div>
<?php endif; ?>

<?php // echo $this->Html->script('search.js', array('inline' => false)); ?>

<div class="grid_24">
<br />
<?php if(!empty($search)) : ?>
<?php if(!empty($products)) : ?>
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
<br />
<br />
</div>
<?php
if (($i % 4) == 0) { echo "<div class=\"clear\"></div>\n";}
endforeach;
?>
<br />
<br />
<br />
<?php else: ?>
<h3>No Results</h3>
<?php endif; ?>
<?php endif; ?>

</div>
<div class="clear"></div>
