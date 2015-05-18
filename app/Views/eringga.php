<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
			/**
			 * The template used for displaying page content
			 *
			 * @package WordPress
			 * @subpackage Twenty_Fifteen
			 * @since Twenty Fifteen 1.0
			 */
			?>

			<article id="post" class="post type-post status-publish format-standard hentry category-uncategorize">

				<div class="entry-content">
					<?php 

						echo  $name;

						?>
						<br>
						Eringga juarak PHP

						<?php

						Template::render("tes.php");

					?>
				</div><!-- .entry-content -->

			
			</article><!-- #post-## -->


		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
