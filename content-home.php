<?php $plasso = get_theme_mod('plasso'); ?>

<?php

// Intro: Get the product intro if toggled.
if($plasso['intro_toggle'] == true) {

?>
<div class="slider animated fadeInUp" <?php if(!empty($plasso['intro_image'])) { ?>style="background-image: url(<?php echo $plasso['intro_image']; ?>);"<?php } ?>>
	<div class="content animated fadeInUp delayed_05s">
		<?php if(!empty($plasso['intro_tagline'])) { ?>
		<h2><?php echo $plasso['intro_tagline']; ?></h2>
		<?php } ?>

		<?php if($plasso['intro_video_toggle'] == true) { ?>
        <a class="btn open start" href="#video" data-video-type="<?php echo $plasso['intro_video_type']; ?>" data-video-id="<?php echo $plasso['intro_video_id']; ?>">Play Video</a>
		<?php } else { ?>
        <?php if(!empty($plasso['space_id'])) { ?>
        <a class="btn plo-button" href="https://plasso.co/s/<?php echo $plasso['space_id']; ?>">Buy Now</a>
        <?php } else { ?>
        <a class="btn" href="<?php echo site_url(); ?>/wp-admin/customize.php">Configure Your Product</a>
        <?php } ?>
		<?php } ?>
	</div>
</div>
<?php } ?>

<?php

// Features: Get the product features if toggled.
if($plasso['features_toggle'] == true) {

?>
<div class="hero-text">
	<div class="content animated fadeInUp delayed_07s">
        <?php if(!empty($plasso['features_intro_headline'])) { ?>
		<h2><?php echo $plasso['features_intro_headline']; ?></h2>
		<?php } ?>

		<hr class="divider">

        <?php if(!empty($plasso['features_intro_text'])) { ?>
		<h6><?php echo $plasso['features_intro_text']; ?></h6>
		<?php } ?>
	</div>
</div>

<div class="features">
	<div class="content animated fadeInUp delayed_09s">
		<div class="grid grid-pad">
        <?php if (!empty($plasso['features_feature'])) {
		    foreach($plasso['features_feature'] as $id => $feature) { ?>
            <div class="col-1-3 mobile-col-1-3">
                <?php if(!empty($feature['icon'])) { ?>
				<img src="<?php echo wp_get_attachment_url($feature['icon']); ?>">
                <?php } ?>

                <h6><?php echo $feature['title']; ?></h6>
			    <p><?php echo $feature['text']; ?></p>
			</div>
			<?php }
		} ?>
		</div>
	</div>
</div>
<?php } ?>

<?php

// Images: Get the product images if toggled.
if($plasso['images_toggle'] == true) {

?>
<div class="image-grid">
	<div class="content">
		<div class="image-grid grid--packery">
            <?php if (!empty($plasso['images_image'])) {
			    foreach($plasso['images_image'] as $image) { ?>
                    <div class="grid-item grid-<?php echo $image['aspect']; ?>" style="background-image: url(<?php echo wp_get_attachment_url($image['image']); ?>);"></div>
				<?php }
			} ?>
		</div>
	</div>
</div>
<?php } ?>

<?php

// Testimonials: Get the product testimonials if toggled.
if($plasso['testimonials_toggle'] == true) {

?>
<div class="testimonials">
	<div class="content">
		<div class="grid grid-pad">
            <?php if (!empty($plasso['testimonials_testimonial'])) {
			    foreach($plasso['testimonials_testimonial'] as $testimonial) { ?>
                    <div class="col-1-3 mobile-col-1-3">
                        <div class="profile" style="background-image: url(<?php echo wp_get_attachment_url($testimonial['profile']); ?>);"></div>

                        <h6><?php echo $testimonial['name']; ?></h6>
        			    <p>“<?php echo $testimonial['quote']; ?>”</p>
        			</div>
				<?php }
			} ?>
		</div>
	</div>
</div>
<?php } ?>

<?php

// Buy: Get the CTA/Buy bar if toggled.
if($plasso['buy_toggle'] == true) {

?>
<div class="cta-bar">
	<div class="content">
        <?php if(!empty($plasso['buy_text'])) { ?>
			<h5><?php echo $plasso['buy_text']; ?></h5>
		<?php } ?>

        <?php if(!empty($plasso['space_id'])) { ?>
    	<a class="btn plo-button" href="https://plasso.co/s/<?php echo $plasso['space_id']; ?>">Buy Now<?php if(!empty($plasso['buy_price'])) { ?> - <?php echo $plasso['buy_price']; ?><?php } ?></a>
        <?php } else { ?>
        <a class="btn" href="<?php echo site_url(); ?>/wp-admin/customize.php">Configure Your Product</a>
        <?php } ?>
	</div>
</div>
<?php } ?>
