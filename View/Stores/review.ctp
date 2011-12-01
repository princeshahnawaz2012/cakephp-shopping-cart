<h2>REVIEW ORDER</h2>

<?php echo $this->Form->create(); ?>


<?php echo $this->Form->input('firatname', array('value' => $paypal[''])); ?>


<?php echo $this->Form->button('Submit Order'); ?>
<?php echo $this->Form->end(); ?>



<?php debug($paypal); ?>

<?php debug($cart); ?>
