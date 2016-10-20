<?php

namespace Onepage;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;


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
        //$id = $parameters['id'];
        
        $control = new $controller;
        $control->$function(isset($id) ? $id : null);
    }
    
    public function url() {
        return $this->request->getPathInfo();
    }
    
    public function load() {
        $routes = new RouteCollection();

        //Admin stuff first, because the admin is important
        $routes->add('admin', new Route('/admin', ['controller' => 'AdminController@index']));
        $routes->add('admin-page', new Route('/admin/page/{id}', ['controller' => 'AdminController@page']));+
        $routes->add('admin-settings', new Route('/admin/settings', ['controller' => 'AdminController@settings']));
        
        $routes->add('home', new Route('/', ['controller' => 'HomeController@home']));
        
        
        return $routes;
        
    }
}