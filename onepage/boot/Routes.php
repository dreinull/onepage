<?php

namespace Onepage\Boot;

use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Onepage\Boot\Config;


class Routes {
    
    //will be like this: https://symfony.com/doc/current/components/routing.html#defining-routes
    
    protected $request;
    
    public function __construct() {
        $this->request = Request::createFromGlobals();
        
        $context = new RequestContext();


        $routes = $this->load();
        $matcher = new UrlMatcher($routes, $context);
        $parameters = $matcher->match($this->url());



        $call = explode('@', $parameters['controller']);
        $controller = 'Onepage\Controller\\' . $call[0];
        $function = $call[1];

        $control = new $controller;
        //var_dump($parameters);
        //call_user_func_array([$control, $function], $parameters);
        $control->$function(isset($parameters['id']) ? $parameters['id'] : null);

    }
    
    public function url() {
        return $this->request->getPathInfo();
    }
    
    public function load() {
        $routes = new RouteCollection();

        //Admin stuff first, because the admin is important
        $routes->add('admin', new Route('/admin', ['controller' => 'AdminController@index']));
        $routes->add('admin-options', new Route('/admin/options', ['controller' => 'AdminController@options']));
        $routes->add('admin-add-page', new Route('/admin/add-page', ['controller' => 'AdminController@addPage']));
        $routes->add('admin-add-page-post', new Route('/admin/added-page', ['controller' => 'AdminController@addPagePost']));
        
        
        $routes->add('admin-page-home', new Route('/admin/page', ['controller' => 'AdminController@home']));
        $routes->add('admin-page', new Route('/admin/page/{id}', ['controller' => 'AdminController@page']));
        $routes->add('admin-section-post', new Route('/admin/section/add', ['controller' => 'AdminController@sectionPost']));
        $routes->add('admin-settings', new Route('/admin/settings', ['controller' => 'AdminController@settings']));

        $routes->add('admin-api-field-update', new Route('/admin/api/field/update', ['controller' => 'AdminController@apiFieldUpdate']));
        $routes->add('admin-api-add-section', new Route('/admin/api/section/post', ['controller' => 'AdminController@apiAddSectionToPage']));
        $routes->add('admin-api-section-order', new Route('/admin/api/section/order', ['controller' => 'AdminController@apiSectionOrder']));

        $routes->add('home', new Route('/', ['controller' => 'PageController@home']));
        $routes->add('page', new Route('/{slug}', ['controller' => 'PageController@page']));


        $this->setToConfig($routes->all());
        
        return $routes;
        
    }

    public function setToConfig($routes) {
        $collection = [];
        foreach($routes as $name => $route) {
            $collection[$name] = $route->getPath();
        }
        Config::setRoutes($collection);
    }
}