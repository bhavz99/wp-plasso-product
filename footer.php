            <?php

            	// Get theme settings.
            	$plasso = get_theme_mod('plasso');

            ?>

            <?php if($plasso['newsletter_toggle'] == true) { ?>
            <div class="newsletter">
                <div class="content">
                    <?php if(!empty($plasso['newsletter_text'])) { ?>
                    <p><?php echo $plasso['newsletter_text']; ?></p>
                    <?php } ?>

                    <form action="" method="post">
                        <input id="mc-email" type="mc-email" name="mc-email" type="email" placeholder="Enter your email address" required />
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            <?php } ?>

            <?php if($plasso['footer_toggle'] == true) { ?>
            <footer>
                <div class="content">
                    <nav class="nav">
                        <?php if (!empty($plasso['footer_menu'])) {
            			    foreach($plasso['footer_menu'] as $menu) { ?>
                                <li><a href="<?php echo get_page_link($menu['page']); ?>"><?php echo $menu['title']; ?></a></li>
            				<?php }
            			} ?>
                    </nav>

                    <?php if(!empty($plasso['footer_text'])) { ?>
                    <p><?php echo $plasso['footer_text']; ?></p>
                    <?php } ?>
                </div>
            </footer>
            <?php } ?>
        </div>

        <?php if($plasso['intro_video_toggle'] == true) { ?>
        <div class="panel inactive" id="video">
            <a class="icon close stop" href="#"></a>

            <div class="content">
            </div>
        </div>
        <?php } ?>

        <?php wp_footer(); ?>
    </body>
</html>