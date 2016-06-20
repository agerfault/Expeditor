<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_79cc4fc2b852d32cbe0218254a4b877a034b840b2ec6d7538519df7274736e3e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_02c3e11e6d009f37eacb32009e449555f72d906c48b3b1fff5bf965d211c5e17 = $this->env->getExtension("native_profiler");
        $__internal_02c3e11e6d009f37eacb32009e449555f72d906c48b3b1fff5bf965d211c5e17->enter($__internal_02c3e11e6d009f37eacb32009e449555f72d906c48b3b1fff5bf965d211c5e17_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_02c3e11e6d009f37eacb32009e449555f72d906c48b3b1fff5bf965d211c5e17->leave($__internal_02c3e11e6d009f37eacb32009e449555f72d906c48b3b1fff5bf965d211c5e17_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_1ced2c87e22f6ba2946560eaa5fd062ce2ce3adbd1bb922cf08bbd56395b35ab = $this->env->getExtension("native_profiler");
        $__internal_1ced2c87e22f6ba2946560eaa5fd062ce2ce3adbd1bb922cf08bbd56395b35ab->enter($__internal_1ced2c87e22f6ba2946560eaa5fd062ce2ce3adbd1bb922cf08bbd56395b35ab_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_1ced2c87e22f6ba2946560eaa5fd062ce2ce3adbd1bb922cf08bbd56395b35ab->leave($__internal_1ced2c87e22f6ba2946560eaa5fd062ce2ce3adbd1bb922cf08bbd56395b35ab_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_ea14f82cd681c1ce09e278e3a36d057f328d39ca0110ca67e8498b376b51c88c = $this->env->getExtension("native_profiler");
        $__internal_ea14f82cd681c1ce09e278e3a36d057f328d39ca0110ca67e8498b376b51c88c->enter($__internal_ea14f82cd681c1ce09e278e3a36d057f328d39ca0110ca67e8498b376b51c88c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_ea14f82cd681c1ce09e278e3a36d057f328d39ca0110ca67e8498b376b51c88c->leave($__internal_ea14f82cd681c1ce09e278e3a36d057f328d39ca0110ca67e8498b376b51c88c_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_e401c985d9627aa3789b4d4253816166805a6ca3a1c170af42c21bdf52a310e0 = $this->env->getExtension("native_profiler");
        $__internal_e401c985d9627aa3789b4d4253816166805a6ca3a1c170af42c21bdf52a310e0->enter($__internal_e401c985d9627aa3789b4d4253816166805a6ca3a1c170af42c21bdf52a310e0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_e401c985d9627aa3789b4d4253816166805a6ca3a1c170af42c21bdf52a310e0->leave($__internal_e401c985d9627aa3789b4d4253816166805a6ca3a1c170af42c21bdf52a310e0_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */
