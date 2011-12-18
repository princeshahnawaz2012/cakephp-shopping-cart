<?php echo $this->set('title_for_layout', 'Address'); ?>

<div class="grid_24">

<h1>Address</h1>

<?php echo $this->Form->create('Order'); ?>

<?php echo $this->Form->input('name'); ?>

<?php echo $this->Form->input('email'); ?>

<?php echo $this->Form->input('phone'); ?>

<br />

<?php echo $this->Form->input('billing_address'); ?>

<?php echo $this->Form->input('billing_address2'); ?>

<?php echo $this->Form->input('billing_city'); ?>

<?php echo $this->Form->input('billing_state'); ?>

<br />

<?php echo $this->Form->input('shipping_address'); ?>

<?php echo $this->Form->input('shipping_address2'); ?>

<?php echo $this->Form->input('shipping_city'); ?>

<?php echo $this->Form->input('shipping_state'); ?>

<br />

<?php echo $this->Form->button('Submit'); ?>

<?php echo $this->Form->end(); ?>

</div>