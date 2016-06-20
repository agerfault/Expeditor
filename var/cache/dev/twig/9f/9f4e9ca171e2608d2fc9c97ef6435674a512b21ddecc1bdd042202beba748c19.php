<?php

/* commande/index.html.twig */
class __TwigTemplate_7f60410d54a60082d58a00e1bb97729910d30f6c3a1f9c2903907f3b4b8a7034 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "commande/index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e5ddc6d583796536a8c6bdb4f2e874603f9534aa5482b81abe52d9b930adbdc5 = $this->env->getExtension("native_profiler");
        $__internal_e5ddc6d583796536a8c6bdb4f2e874603f9534aa5482b81abe52d9b930adbdc5->enter($__internal_e5ddc6d583796536a8c6bdb4f2e874603f9534aa5482b81abe52d9b930adbdc5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "commande/index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e5ddc6d583796536a8c6bdb4f2e874603f9534aa5482b81abe52d9b930adbdc5->leave($__internal_e5ddc6d583796536a8c6bdb4f2e874603f9534aa5482b81abe52d9b930adbdc5_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_29a83613ebbc2615b1b18a0a7aab50ff4844464a92585c9f235d53f79d0ced2f = $this->env->getExtension("native_profiler");
        $__internal_29a83613ebbc2615b1b18a0a7aab50ff4844464a92585c9f235d53f79d0ced2f->enter($__internal_29a83613ebbc2615b1b18a0a7aab50ff4844464a92585c9f235d53f79d0ced2f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <h1>Commande list</h1>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Statut</th>
                <th>Idcommande</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["commandes"]) ? $context["commandes"] : $this->getContext($context, "commandes")));
        foreach ($context['_seq'] as $context["_key"] => $context["commande"]) {
            // line 17
            echo "            <tr>
                <td><a href=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("commande_show", array("id" => $this->getAttribute($context["commande"], "idcommande", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["commande"], "date", array()), "html", null, true);
            echo "</a></td>
                <td>";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["commande"], "statut", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["commande"], "idcommande", array()), "html", null, true);
            echo "</td>
                <td>
                    <ul>
                        <li>
                            <a href=\"";
            // line 24
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("commande_show", array("id" => $this->getAttribute($context["commande"], "idcommande", array()))), "html", null, true);
            echo "\">show</a>
                        </li>
                        <li>
                            <a href=\"";
            // line 27
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("commande_edit", array("id" => $this->getAttribute($context["commande"], "idcommande", array()))), "html", null, true);
            echo "\">edit</a>
                        </li>
                    </ul>
                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['commande'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        echo "        </tbody>
    </table>

    <ul>
        <li>
            <a href=\"";
        // line 38
        echo $this->env->getExtension('routing')->getPath("commande_new");
        echo "\">Create a new entry</a>
        </li>
    </ul>
";
        
        $__internal_29a83613ebbc2615b1b18a0a7aab50ff4844464a92585c9f235d53f79d0ced2f->leave($__internal_29a83613ebbc2615b1b18a0a7aab50ff4844464a92585c9f235d53f79d0ced2f_prof);

    }

    public function getTemplateName()
    {
        return "commande/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  103 => 38,  96 => 33,  84 => 27,  78 => 24,  71 => 20,  67 => 19,  61 => 18,  58 => 17,  54 => 16,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'base.html.twig' %}*/
/* */
/* {% block body %}*/
/*     <h1>Commande list</h1>*/
/* */
/*     <table>*/
/*         <thead>*/
/*             <tr>*/
/*                 <th>Date</th>*/
/*                 <th>Statut</th>*/
/*                 <th>Idcommande</th>*/
/*                 <th>Actions</th>*/
/*             </tr>*/
/*         </thead>*/
/*         <tbody>*/
/*         {% for commande in commandes %}*/
/*             <tr>*/
/*                 <td><a href="{{ path('commande_show', { 'id': commande.idcommande }) }}">{{ commande.date }}</a></td>*/
/*                 <td>{{ commande.statut }}</td>*/
/*                 <td>{{ commande.idcommande }}</td>*/
/*                 <td>*/
/*                     <ul>*/
/*                         <li>*/
/*                             <a href="{{ path('commande_show', { 'id': commande.idcommande }) }}">show</a>*/
/*                         </li>*/
/*                         <li>*/
/*                             <a href="{{ path('commande_edit', { 'id': commande.idcommande }) }}">edit</a>*/
/*                         </li>*/
/*                     </ul>*/
/*                 </td>*/
/*             </tr>*/
/*         {% endfor %}*/
/*         </tbody>*/
/*     </table>*/
/* */
/*     <ul>*/
/*         <li>*/
/*             <a href="{{ path('commande_new') }}">Create a new entry</a>*/
/*         </li>*/
/*     </ul>*/
/* {% endblock %}*/
/* */
