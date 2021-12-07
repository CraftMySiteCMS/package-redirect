<?php

use CMS\Controller\redirect\redirectController;
use CMS\Router\router;

require_once('Lang/'.getenv("LOCALE").'.php');

/** @var $router router Main router */

//Admin pages
$router->scope('/cms-admin/redirect', function($router) {
    $router->get('/list', "redirect#frontRedirectListAdmin");

    $router->get('/add', "redirect#create");
    $router->post('/add', "redirect#createPost");

    $router->get('/edit/:id', function($id) {
        (new redirectController)->edit($id);
    })->with('id', '[0-9]+');
    $router->post('/edit/:id', function($id) {
        (new redirectController)->editPost($id);
    })->with('id', '[0-9]+');


    $router->get('/delete/:id', function($id) {
        (new redirectController)->delete($id);
    })->with('id', '[0-9]+');
    $router->get('/delete/:id', function($id) {
        (new redirectController)->delete($id);
    })->with('id', '[0-9]+');


    $router->get('/stats', "redirect#stats");

});


$router->scope('/cms-admin/redirect/list', function($router) {



//Public redirect
    $router->scope('/r', function ($router){

        $router->get('/:url/:slug', function($url,$slug) {
            (new redirectController)->redirect($url,$slug);
        })->with('slug', '.*?');

    });

});