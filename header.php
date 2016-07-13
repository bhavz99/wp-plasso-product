<?php

	// Get theme settings.
	$plasso = get_theme_mod('plasso');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"/>
		<?php wp_head(); ?>
	</head>

    <body>
		<?php

		// Welcome: If nothing has been customized, fet the welcome template.
		if(
	        $plasso['header_toggle'] == false &&
	        $plasso['intro_toggle'] == false &&
	        $plasso['features_toggle'] == false &&
	        $plasso['images_toggle'] == false &&
	        $plasso['testimonials_toggle'] == false &&
	        $plasso['buy_toggle'] == false &&
	        $plasso['newsletter_toggle'] == false &&
	        $plasso['footer_toggle'] == false
	    ) {
	        get_template_part('welcome');
	    }
		
		?>

        <div class="mobile-menu">
            <ul>
                <?php if (!empty($plasso['header_menu'])) {
    			    foreach($plasso['header_menu'] as $menu) { ?>
                        <li><a href="<?php echo get_page_link($menu['page']); ?>"><?php echo $menu['title']; ?></a></li>
    				<?php }
    			} ?>

				<?php if(!empty($plasso['space_id'])) { ?>
                <li><a class="btn plo-button" href="https://plasso.co/s/<?php echo $plasso['space_id']; ?>">Buy Now</a></li>
				<?php } else { ?>
		        <a class="btn" href="<?php echo site_url(); ?>/wp-admin/customize.php">Configure Your Product</a>
		        <?php } ?>
            </ul>
        </div>

        <div class="wrapper">
			<?php if($plasso['header_toggle'] == true) { ?>
            <header class="header clearfix animated fadeInDown">
        		<div class="content">
                    <?php if(!empty($plasso['header_logo'])) { ?>
        			    <a class="logo" href="<?php echo site_url(); ?>"><img src="<?php echo $plasso['header_logo']; ?>"></a>
                    <?php } else { ?>
                        <h1><a href="<?php echo site_url(); ?>"><?php echo $plasso['header_text']; ?></a></h1>
            		<?php } ?>

        			<ul class="clearfix nav">
                        <?php if (!empty($plasso['header_menu'])) {
            			    foreach($plasso['header_menu'] as $menu) { ?>
                                <li><a href="<?php echo get_page_link($menu['page']); ?>"><?php echo $menu['title']; ?></a></li>
            				<?php }
            			} ?>

						<?php if(!empty($plasso['space_id'])) { ?>
        				<li><a class="btn plo-button" href="https://plasso.co/s/<?php echo $plasso['space_id']; ?>">Buy Now</a></li>
						<?php } else { ?>
				        <a class="btn" href="<?php echo site_url(); ?>/wp-admin/customize.php">Configure Your Product</a>
				        <?php } ?>
					</ul>

        		    <button type="button" class="toggle-menu visible-xs" aria-label="Toggle Mobile Menu">
        		        <span class="burger-lines"></span>
        		    </button>
        		</div>
        	</header>
			<?php } ?>
