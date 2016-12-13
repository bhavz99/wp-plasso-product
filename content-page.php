<?php $plasso = get_theme_mod('plasso'); ?>

<div class="blog">
	<div class="content">
		<div class="posts">
      <?php while(have_posts()) : the_post(); ?>
      <div class="post">
    		<h3 class="title"><?php the_title(); ?></h3>
    		<?php the_content(); ?>
			</div>
    	<?php endwhile; ?>
		</div>
	</div>
</div>
