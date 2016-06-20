<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        if (0 === strpos($pathinfo, '/article')) {
            // article_index
            if (rtrim($pathinfo, '/') === '/article') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_article_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'article_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\ArticleController::indexAction',  '_route' => 'article_index',);
            }
            not_article_index:

            // article_new
            if ($pathinfo === '/article/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_article_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\ArticleController::newAction',  '_route' => 'article_new',);
            }
            not_article_new:

            // article_show
            if (preg_match('#^/article/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_article_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_show')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::showAction',));
            }
            not_article_show:

            // article_edit
            if (preg_match('#^/article/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_article_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_edit')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::editAction',));
            }
            not_article_edit:

            // article_delete
            if (preg_match('#^/article/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_article_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'article_delete')), array (  '_controller' => 'AppBundle\\Controller\\ArticleController::deleteAction',));
            }
            not_article_delete:

        }

        if (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/client')) {
                // client_index
                if (rtrim($pathinfo, '/') === '/client') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_client_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'client_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\ClientController::indexAction',  '_route' => 'client_index',);
                }
                not_client_index:

                // client_new
                if ($pathinfo === '/client/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_client_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\ClientController::newAction',  '_route' => 'client_new',);
                }
                not_client_new:

                // client_show
                if (preg_match('#^/client/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_client_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'client_show')), array (  '_controller' => 'AppBundle\\Controller\\ClientController::showAction',));
                }
                not_client_show:

                // client_edit
                if (preg_match('#^/client/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_client_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'client_edit')), array (  '_controller' => 'AppBundle\\Controller\\ClientController::editAction',));
                }
                not_client_edit:

                // client_delete
                if (preg_match('#^/client/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_client_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'client_delete')), array (  '_controller' => 'AppBundle\\Controller\\ClientController::deleteAction',));
                }
                not_client_delete:

            }

            if (0 === strpos($pathinfo, '/commande')) {
                // commande_index
                if (rtrim($pathinfo, '/') === '/commande') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_commande_index;
                    }

                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'commande_index');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\CommandeController::indexAction',  '_route' => 'commande_index',);
                }
                not_commande_index:

                // commande_new
                if ($pathinfo === '/commande/new') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_commande_new;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\CommandeController::newAction',  '_route' => 'commande_new',);
                }
                not_commande_new:

                // commande_show
                if (preg_match('#^/commande/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_commande_show;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'commande_show')), array (  '_controller' => 'AppBundle\\Controller\\CommandeController::showAction',));
                }
                not_commande_show:

                // commande_edit
                if (preg_match('#^/commande/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_commande_edit;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'commande_edit')), array (  '_controller' => 'AppBundle\\Controller\\CommandeController::editAction',));
                }
                not_commande_edit:

                // commande_delete
                if (preg_match('#^/commande/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_commande_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'commande_delete')), array (  '_controller' => 'AppBundle\\Controller\\CommandeController::deleteAction',));
                }
                not_commande_delete:

            }

        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        if (0 === strpos($pathinfo, '/employe')) {
            // employe_index
            if (rtrim($pathinfo, '/') === '/employe') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_employe_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'employe_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EmployeController::indexAction',  '_route' => 'employe_index',);
            }
            not_employe_index:

            // employe_new
            if ($pathinfo === '/employe/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_employe_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\EmployeController::newAction',  '_route' => 'employe_new',);
            }
            not_employe_new:

            // employe_show
            if (preg_match('#^/employe/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_employe_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'employe_show')), array (  '_controller' => 'AppBundle\\Controller\\EmployeController::showAction',));
            }
            not_employe_show:

            // employe_edit
            if (preg_match('#^/employe/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_employe_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'employe_edit')), array (  '_controller' => 'AppBundle\\Controller\\EmployeController::editAction',));
            }
            not_employe_edit:

            // employe_delete
            if (preg_match('#^/employe/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_employe_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'employe_delete')), array (  '_controller' => 'AppBundle\\Controller\\EmployeController::deleteAction',));
            }
            not_employe_delete:

        }

        if (0 === strpos($pathinfo, '/gestioncommande')) {
            // gestioncommande_index
            if (rtrim($pathinfo, '/') === '/gestioncommande') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_gestioncommande_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gestioncommande_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\GestioncommandeController::indexAction',  '_route' => 'gestioncommande_index',);
            }
            not_gestioncommande_index:

            // gestioncommande_new
            if ($pathinfo === '/gestioncommande/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_gestioncommande_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\GestioncommandeController::newAction',  '_route' => 'gestioncommande_new',);
            }
            not_gestioncommande_new:

            // gestioncommande_show
            if (preg_match('#^/gestioncommande/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_gestioncommande_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gestioncommande_show')), array (  '_controller' => 'AppBundle\\Controller\\GestioncommandeController::showAction',));
            }
            not_gestioncommande_show:

            // gestioncommande_edit
            if (preg_match('#^/gestioncommande/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_gestioncommande_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gestioncommande_edit')), array (  '_controller' => 'AppBundle\\Controller\\GestioncommandeController::editAction',));
            }
            not_gestioncommande_edit:

            // gestioncommande_delete
            if (preg_match('#^/gestioncommande/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_gestioncommande_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gestioncommande_delete')), array (  '_controller' => 'AppBundle\\Controller\\GestioncommandeController::deleteAction',));
            }
            not_gestioncommande_delete:

        }

        if (0 === strpos($pathinfo, '/lignearticle')) {
            // lignearticle_index
            if (rtrim($pathinfo, '/') === '/lignearticle') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_lignearticle_index;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'lignearticle_index');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\LignearticleController::indexAction',  '_route' => 'lignearticle_index',);
            }
            not_lignearticle_index:

            // lignearticle_new
            if ($pathinfo === '/lignearticle/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_lignearticle_new;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\LignearticleController::newAction',  '_route' => 'lignearticle_new',);
            }
            not_lignearticle_new:

            // lignearticle_show
            if (preg_match('#^/lignearticle/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_lignearticle_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'lignearticle_show')), array (  '_controller' => 'AppBundle\\Controller\\LignearticleController::showAction',));
            }
            not_lignearticle_show:

            // lignearticle_edit
            if (preg_match('#^/lignearticle/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_lignearticle_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'lignearticle_edit')), array (  '_controller' => 'AppBundle\\Controller\\LignearticleController::editAction',));
            }
            not_lignearticle_edit:

            // lignearticle_delete
            if (preg_match('#^/lignearticle/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'DELETE') {
                    $allow[] = 'DELETE';
                    goto not_lignearticle_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'lignearticle_delete')), array (  '_controller' => 'AppBundle\\Controller\\LignearticleController::deleteAction',));
            }
            not_lignearticle_delete:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
