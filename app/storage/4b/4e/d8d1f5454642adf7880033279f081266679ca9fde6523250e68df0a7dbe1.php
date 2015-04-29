<?php

/* eringga.php */
class __TwigTemplate_4b4ed8d1f5454642adf7880033279f081266679ca9fde6523250e68df0a7dbe1 extends Twig_Template
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

Eringga juarak

";
    }

    public function getTemplateName()
    {
        return "eringga.php";
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
