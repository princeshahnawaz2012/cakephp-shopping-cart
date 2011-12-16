Order:

Name: <?php echo $shop['Data']['name'];?>

Email: <?php echo $shop['Data']['email'];?>

Phone: <?php echo $shop['Data']['phone'];?>


Billing Address: <?php echo $shop['Data']['billing_address'];?>

Billing Address 2: <?php echo $shop['Data']['billing_address2'];?>

Billing City: <?php echo $shop['Data']['billing_city'];?>

Billing State: <?php echo $shop['Data']['billing_state'];?>


Shipping Address: <?php echo $shop['Data']['shipping_address'];?>

Shipping Address 2: <?php echo $shop['Data']['shipping_address2'];?>

Shipping City: <?php echo $shop['Data']['shipping_city'];?>

Shipping State: <?php echo $shop['Data']['shipping_state'];?>



Description			Item Price			Quantity			Extended Price
<?php foreach ($shop['Cart']['items'] as $item): ?>
<?php echo $item['Product']['name']; ?>			$<?php echo $item['Product']['price']; ?>			<?php echo $item['quantity']; ?>			$<?php echo $item['subtotal']; ?>

<?php endforeach; ?>

Items: <?php echo $shop['Cart']['property']['cartQuantity'];?>

Total: $<?php echo $shop['Cart']['property']['cartTotal'];?>

<?php print_r($shop); ?>