<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_bc966c574ee31088a98d755655f7404387bec4822630d3c5325ac4950a19310a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_cf697fa149a80d2fc842f840f47b58d7f5cf65f52851e1271c58c17411024a6b = $this->env->getExtension("native_profiler");
        $__internal_cf697fa149a80d2fc842f840f47b58d7f5cf65f52851e1271c58c17411024a6b->enter($__internal_cf697fa149a80d2fc842f840f47b58d7f5cf65f52851e1271c58c17411024a6b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cf697fa149a80d2fc842f840f47b58d7f5cf65f52851e1271c58c17411024a6b->leave($__internal_cf697fa149a80d2fc842f840f47b58d7f5cf65f52851e1271c58c17411024a6b_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_9d7cbe9ed45b5e82340f5d47a80aad377190a251a6e925877ce6b0db4400c682 = $this->env->getExtension("native_profiler");
        $__internal_9d7cbe9ed45b5e82340f5d47a80aad377190a251a6e925877ce6b0db4400c682->enter($__internal_9d7cbe9ed45b5e82340f5d47a80aad377190a251a6e925877ce6b0db4400c682_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_9d7cbe9ed45b5e82340f5d47a80aad377190a251a6e925877ce6b0db4400c682->leave($__internal_9d7cbe9ed45b5e82340f5d47a80aad377190a251a6e925877ce6b0db4400c682_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_adfe5782c429915b9864556287c7f267516c062c24a998c500f9e030da1e07f5 = $this->env->getExtension("native_profiler");
        $__internal_adfe5782c429915b9864556287c7f267516c062c24a998c500f9e030da1e07f5->enter($__internal_adfe5782c429915b9864556287c7f267516c062c24a998c500f9e030da1e07f5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_adfe5782c429915b9864556287c7f267516c062c24a998c500f9e030da1e07f5->leave($__internal_adfe5782c429915b9864556287c7f267516c062c24a998c500f9e030da1e07f5_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_23f54672a5ba4bb7911ad45ce236735705ab3da7fa9d932f03e6858ebc781d00 = $this->env->getExtension("native_profiler");
        $__internal_23f54672a5ba4bb7911ad45ce236735705ab3da7fa9d932f03e6858ebc781d00->enter($__internal_23f54672a5ba4bb7911ad45ce236735705ab3da7fa9d932f03e6858ebc781d00_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_23f54672a5ba4bb7911ad45ce236735705ab3da7fa9d932f03e6858ebc781d00->leave($__internal_23f54672a5ba4bb7911ad45ce236735705ab3da7fa9d932f03e6858ebc781d00_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@WebProfiler/Profiler/layout.html.twig' %}*/
/* */
/* {% block toolbar %}{% endblock %}*/
/* */
/* {% block menu %}*/
/* <span class="label">*/
/*     <span class="icon">{{ include('@WebProfiler/Icon/router.svg') }}</span>*/
/*     <strong>Routing</strong>*/
/* </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {{ render(path('_profiler_router', { token: token })) }}*/
/* {% endblock %}*/
/* */
