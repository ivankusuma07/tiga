<?php

/* default.php */
class __TwigTemplate_7664f8c50fe99fd32e39d1fb45653a7acab3f5d4af2f7887a134243d28b429d6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other \"pages\" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

\t<div id=\"primary\" class=\"content-area\">
\t\t<main id=\"main\" class=\"site-main\" role=\"main\">

\t\t<?php
\t\t// Start the loop.
\t\twhile ( have_posts() ) : the_post();

\t\t\t// Include the page content template.
\t\t\tget_template_part( 'content', 'page' );

\t\t\t// If comments are open or we have at least one comment, load up the comment template.
\t\t\tif ( comments_open() || get_comments_number() ) :
\t\t\t\tcomments_template();
\t\t\tendif;

\t\t// End the loop.
\t\tendwhile;
\t\t?>

\t\t</main><!-- .site-main -->
\t</div><!-- .content-area -->

<?php get_footer(); ?>
";
    }

    public function getTemplateName()
    {
        return "default.php";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
