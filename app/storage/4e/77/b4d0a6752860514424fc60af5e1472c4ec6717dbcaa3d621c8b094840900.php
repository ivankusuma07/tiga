<?php

/* eringga.twig */
class __TwigTemplate_4e77b4d0a6752860514424fc60af5e1472c4ec6717dbcaa3d621c8b094840900 extends Twig_Template
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
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "
TWIG
Eringga juarak

";
    }

    public function getTemplateName()
    {
        return "eringga.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
