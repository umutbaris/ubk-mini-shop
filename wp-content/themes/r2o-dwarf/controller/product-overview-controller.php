<?php
new productOverviewController;
/**
 * 	First Page of application
 */
class productOverviewController {
	function __construct() {
		$this->get_page_data();
	 }
	 /**
	  * This method fetch product values from json api and and generate html page.
	  * Actually I don't prefer to use inline php but I am not good at UI side I prefer to
	  * coding back end.
	  * @return void
	  */
	public function get_page_data() {
		$data = json_decode(file_get_contents('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?json=1'), true);
		$posts = $data['posts'];
		$card_icon = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']."images/cart-icon.svg"
		?>
		<label class="slogan"><span class="tc_slogan">Buy Something</span> From MiniShop.</label>

		<div class="row">
		<?php

		foreach( $posts as $post ) { 
			$title = $post['title'];
			$url   = $post['url'];
			$id    = $post['id'];
			$image_url   = $post['attachments'][0]['images']['thumbnail']['url'];
			$description = $post['custom_fields']['description'][0];
			$price 		 = $post['custom_fields']['price'][0];;
			$count		 = $post['custom_fields']['count'][0];
			if ( $post['categories'][0]['slug'] == 'products' ) {
			?>
				<div class="col-lg-4 col-sm-12">
					<form method="post">
							<div class="card">
								<input type="hidden" id="post_id" name="post_id" value="<?=$id?>">
								<h1 class="height-text"><?= $title ?></h1>
								<div class="image-border">
								<img class="product-image" src="<?=$image_url?>" alt="">
								</div>
								<p class="height-text"><?= $description ?></p>
								<p class="price"><?= $price ?></p>
								<?php if ($count > 0) : ?>
								<input class="quantity" id="quantity"name="quantity" type="number" min="1" max="<?=$count?>" value="1"/>
								<input type="submit" value="Add to Card" name="insert" class="add-button btn-block"/>
								<img class="card-icon" src="<?=$card_icon?>" alt="">

								<?php else : ?>
									<p><?php echo "This product is not available !" ?></p>
								<?php endif;  ?>
							</div>
					</form>
				</div>

		<?php
		 }
	} ?>
		</div> 
		<?php
		if( array_key_exists('insert', $_POST ) ){
			$this->add_card_to_session( $_POST["post_id"], $_POST["quantity"] );
		 }
		 if( array_key_exists('delete',$_POST ) ){
			$this->delete_card_to_session ( $_POST["post_id"]);
		 }
 }
	/**
	 * Adding card to session according to form
	 *
	 * @param [type] $id
	 * @param [type] $quantity
	 * @return void
	 */
	public function add_card_to_session ( $id ,$quantity ) {
		$_SESSION['card'][$id] = $quantity;
	}
	/**
	 * Delete card from session
	 *
	 * @param [type] $id
	 * @return void
	 */
	public function delete_card_to_session ( $id ) {
		unset( $_SESSION['card'][$id]);
	}
}

?>
<div class="row">
	<div class="col-xs-12 col-sm-8">
		<?php 
				foreach ( $_SESSION['card'] as $card => $quantity ) {
					$post = get_post($card);
					$post->post_title;
					?>
					<form method="post">
						<div>
							<input name="post_id" type="hidden" value="<?=$post->ID?>"/>
							<div class="row">
									<div class="col-xs-12 col-md-6">
										<label class="product-list"> <?=$post->post_title . " ( " . $quantity . " )" ?> </label>	
									</div>
										<div class="col-xs-12 col-sm-4 col-md-6">
									<input name="delete" type="submit" class="remove-card" value="Remove Card"/>
								</div>
							</div>
						</div>
					</form>
					<?php
				}
?>
	</div> 
		<div class="col-xs-12 col-sm-12 col-md-4">
			<?php if ( empty($_SESSION['card'] )) {
			 ?>  <?php
			}
			else {
			?> 
			<a href="checkout/" class="add-button continue" >Continue</a>
			<script>
			window.scrollTo(0,document.body.scrollHeight);
			</script>
			<?php } ?>
		</div> 
	</div> 
