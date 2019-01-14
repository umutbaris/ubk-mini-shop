<?php

new checkoutController;

class checkoutController {

	function __construct() {
		$this->check_inputs();
	 }
	 /**
	  * Input validations make by php. UI side validatons can be use
	  * with javascript I think it is more useful. But I prefered my 
	  * mother tongue ( :P ) as PHP
	  *
	  * @return void
	  */
	 public function check_inputs () {
		$data = json_decode(file_get_contents('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?json=1'), true);
		if( array_key_exists('insert', $_POST ) ){
			$name  = $_POST["fullname"];
			$email = $_POST["email"];
			$address = $_POST["address"];
			$city = $_POST["city"];

			if ( $name == "" || $email == ""  || $address == "" || $address == "") {
				$err = "All Fields Are Required !"; 
			}
			else if ( !preg_match("/^[a-zA-Z ]*$/", $name ) ) {
				$err = "Full Name : Only letters and white space allowed !";
			}
			else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
				$err = "Invalid email format !"; 
			}
			else {
				$this->create_order( $_POST );
			}
		 }
		?>

	<form method="post">
		<div class="row">
			<div class = "col-sm-12 col-md-8">

					<?php 
					foreach ( $_SESSION['card'] as $card => $quantity ) {
						$post = get_post( $card );
						$title = $post->post_title;
						$image=$post->post_content;
						$price = get_post_meta( $post->ID, 'price', true);
						$tax = $price * 20 / 100;
						$price_tax = $price + $tax;
						$subtotal = $quantity * $price_tax;
					?>

					<div class="order-card">
						<div class="row">
							<div class="col-md-4">
							<?=$image?>
							</div>
							<div class="col-md-8">
								<div>
								<h1 class=""><?=$title ?></h1>
								<input type="hidden" id="product" name="product" value="<?=$title ?>">
								<p class="price price-checkout">price = <?=$price ?></p>
								<p class="price price-checkout">tax(20%) = <?=$tax?></p>
								<p class="price price-checkout">quantity = <?=$quantity?></p>
								<p class="price price-checkout">subtotal = <?=$subtotal?></p>

								</div>
							</div>
						</div>
					</div>

					<?php 
					$total[].= $subtotal;
					} 
					$total = array_sum($total);
					if ( empty ( $_SESSION['card'] ) ) {
						?>
						<label class="error"> Invalid Form ! Any card not selected. </label>
						<a href="shop/"> Go Shopping Page </a> 
						<?php
					}else {
					?>
					<p class="price price-checkout total-payment">Total Payment = <?=$total ?></p>
				</div>

				<div class = "col-sm-12 col-md-4">
					<label for="fname"><i class="fa fa-user"></i> Full Name</label>
					<input type="text" id="fname" name="fullname" placeholder="">
					<label for="email"><i class="fa fa-envelope"></i> Email</label>
					<input type="text" id="email" name="email" placeholder="">
					<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
					<input type="text" id="adr" name="address" placeholder="">
					<label for="city"><i class="fa fa-institution"></i> City</label>
					<input type="text" id="city" name="city" placeholder="">
					<label class="error" </i><?=$err ?></label>
					<input type="submit" value="Checkout" name="insert" class="add-button btn-block">
					<?php } ?>
				</div>

		</div>
	</form>
<?php 
	 }

	 /**
	  * Get form values about customer and
	  * and get products from session after
	  * add order to database with wp queries.
	  * Orders will list in posts with orders category
	  * @param [type] $order
	  * @return void
	  */
	 public function create_order ( $checkout ) {
		$name = $checkout['fullname'];
		$email = $checkout['email'];
		$address = $checkout['address'];
		$city = $checkout['city'];

		foreach ( $_SESSION['card'] as $card => $quantity ) {
			$post = get_post( $card );
			$price = get_post_meta( $card, "price", true );
			$tax   = $price * 20 / 100;
			$pricetax = $price + $tax;
			$subtotal = $pricetax * $quantity;
			$products[].= $post->post_title;
			$subtotals[].=  $subtotal;
			$quantities[].= $quantity;
			$total[].= $subtotal;
			$this->calculate_last_count( $post->ID, $quantity);
		}

		$total = array_sum($total);
		$order = [
			'post_title' => "order" . uniqid(),
			'meta_input' => [
				'name' 	=> $name,
				'email' => $email,
				'address' => $address,
				'city' => $city,
				'order' => [
					'products' => $products,
					'subtotals' => $subtotals,
					'quantities' => $quantities,
					'total' => $total,
				],
				
			]
		 ];
		 $post_id = wp_insert_post($order, $wp_err);
		 wp_set_object_terms( $post_id, 'orders', 'orders' );
		?>
		<script>
		window.location = 'success/';
		</script>
		<?php
		unset( $_SESSION['card'] );
	 }

	 /**
	  * Method decrease product count for every sales.
	  *
	  * @param [type] $id
	  * @param [type] $quantity
	  * @return void
	  */
	 public function calculate_last_count ( $id, $quantity ) {
		$count = get_post_meta( $id, 'count',true );
		$last_count = $count - $quantity;
		update_post_meta( $id, 'count', $last_count, $count );
	 }
}

?>