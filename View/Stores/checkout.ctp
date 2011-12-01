<h1>checkout</h1>

<?php echo $this->Form->create('Order'); ?>

<?php echo $this->Form->input('name'); ?>

<?php echo $this->Form->input('email'); ?>

<?php echo $this->Form->input('phone'); ?>

<?php echo $this->Form->input('billing_address'); ?>

<?php echo $this->Form->input('billing_address2'); ?>

<?php echo $this->Form->input('billing_city'); ?>

<?php echo $this->Form->input('billing_state'); ?>

<?php echo $this->Form->input('shipping_address'); ?>

<?php echo $this->Form->input('shipping_address2'); ?>

<?php echo $this->Form->input('shipping_city'); ?>

<?php echo $this->Form->input('shipping_state'); ?>

<?php echo $this->Form->button('Submit'); ?>

<?php echo $this->Form->end(); ?>
