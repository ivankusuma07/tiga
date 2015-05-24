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
			
	<div id="content" class="clearfix row">
	
		<div id="main" class="col-sm-12 clearfix" role="main">

		<?php
			if(Flash::has('message')){
				echo "<div class='alert ".Flash::get('type')."'>";
				echo Flash::get('message');
				echo "</div>";
			}
		?>

		<?php include __DIR__."/{$template}" ?>

		</div><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>

