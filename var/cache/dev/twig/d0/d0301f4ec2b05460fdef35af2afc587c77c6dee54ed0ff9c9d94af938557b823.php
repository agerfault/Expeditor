<?php

/* base.html.twig */
class __TwigTemplate_b22abfecc98b44c389e8f325cbff1a78510f4d0eba36e9ca64e30b52958f6177 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_50bbc57fff5c85b9d4ac103fa8eed3ab1df42aeacd75b2e58852011883706945 = $this->env->getExtension("native_profiler");
        $__internal_50bbc57fff5c85b9d4ac103fa8eed3ab1df42aeacd75b2e58852011883706945->enter($__internal_50bbc57fff5c85b9d4ac103fa8eed3ab1df42aeacd75b2e58852011883706945_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_50bbc57fff5c85b9d4ac103fa8eed3ab1df42aeacd75b2e58852011883706945->leave($__internal_50bbc57fff5c85b9d4ac103fa8eed3ab1df42aeacd75b2e58852011883706945_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_70864233519734011ccf7872123b4a9ad77bf48b783d36e56f9b5109d1d2d826 = $this->env->getExtension("native_profiler");
        $__internal_70864233519734011ccf7872123b4a9ad77bf48b783d36e56f9b5109d1d2d826->enter($__internal_70864233519734011ccf7872123b4a9ad77bf48b783d36e56f9b5109d1d2d826_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_70864233519734011ccf7872123b4a9ad77bf48b783d36e56f9b5109d1d2d826->leave($__internal_70864233519734011ccf7872123b4a9ad77bf48b783d36e56f9b5109d1d2d826_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_f2d34e713e4f37f2172fe7416939f5f8cf072aaa36a98f67aa4ffa515e9d73d2 = $this->env->getExtension("native_profiler");
        $__internal_f2d34e713e4f37f2172fe7416939f5f8cf072aaa36a98f67aa4ffa515e9d73d2->enter($__internal_f2d34e713e4f37f2172fe7416939f5f8cf072aaa36a98f67aa4ffa515e9d73d2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_f2d34e713e4f37f2172fe7416939f5f8cf072aaa36a98f67aa4ffa515e9d73d2->leave($__internal_f2d34e713e4f37f2172fe7416939f5f8cf072aaa36a98f67aa4ffa515e9d73d2_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_edfdda709c5e100d3e52bbfeb0d2a201963e78b16bc448298bfde9e0c5c9aa70 = $this->env->getExtension("native_profiler");
        $__internal_edfdda709c5e100d3e52bbfeb0d2a201963e78b16bc448298bfde9e0c5c9aa70->enter($__internal_edfdda709c5e100d3e52bbfeb0d2a201963e78b16bc448298bfde9e0c5c9aa70_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_edfdda709c5e100d3e52bbfeb0d2a201963e78b16bc448298bfde9e0c5c9aa70->leave($__internal_edfdda709c5e100d3e52bbfeb0d2a201963e78b16bc448298bfde9e0c5c9aa70_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_5c61b6452a5e6d4d06405ab99f8bbe88274f4e7c359868f34916b7b88ec55966 = $this->env->getExtension("native_profiler");
        $__internal_5c61b6452a5e6d4d06405ab99f8bbe88274f4e7c359868f34916b7b88ec55966->enter($__internal_5c61b6452a5e6d4d06405ab99f8bbe88274f4e7c359868f34916b7b88ec55966_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_5c61b6452a5e6d4d06405ab99f8bbe88274f4e7c359868f34916b7b88ec55966->leave($__internal_5c61b6452a5e6d4d06405ab99f8bbe88274f4e7c359868f34916b7b88ec55966_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta charset="UTF-8" />*/
/*         <title>{% block title %}Welcome!{% endblock %}</title>*/
/*         {% block stylesheets %}{% endblock %}*/
/*         <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/*     </head>*/
/*     <body>*/
/*         {% block body %}{% endblock %}*/
/*         {% block javascripts %}{% endblock %}*/
/*     </body>*/
/* </html>*/
/* */
