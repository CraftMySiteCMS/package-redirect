<?php
namespace CMS\Controller\Redirect;

use CMS\Controller\coreController;
use CMS\Controller\users\usersController;
use CMS\Model\Redirect\redirectModel;
use CMS\Model\users\usersModel;


/**
 * Class: @redirectController
 * @package redirect
 * @author Teyir | CraftMySite <contact@craftmysite.fr>
 * @version 1.0
 */

class redirectController extends coreController
{

    public static string $themePath;

    public function __construct($themePath = null)
    {
        parent::__construct($themePath);
    }

    public function frontRedirectListAdmin(){
        $redirect = new redirectModel();

        //Get all redirect
        $redirectList = $redirect->fetchAll();

        //Include the view file ("views/list.admin.view.php").
        view('redirect', 'list.admin', ["redirect" => $redirect, "redirectList" => $redirectList], 'admin');
    }

    public function create(){
        usersController::isAdminLogged();

        $redirect = new redirectModel();

        $urlList = $redirect->urlList();

        view('redirect', 'add.admin', ["urlList" => $urlList], 'admin');
    }

    public function createPost(){
        usersController::isAdminLogged();

        $redirect = new redirectModel();

        $redirect->name = filter_input(INPUT_POST, "name");
        $redirect->url = filter_input(INPUT_POST, "url");
        $redirect->slug = filter_input(INPUT_POST, "slug");
        $redirect->target = filter_input(INPUT_POST, "target");

        $redirect->create();

        header("location: ../redirect/list");
    }

    public function edit($id){
        usersController::isAdminLogged();

        $redirect = new redirectModel();
        $redirect->fetch($id);

        $urlList = $redirect->urlList();

        view('redirect', 'edit.admin', ["redirect" => $redirect, "urlList" => $urlList], 'admin');
    }

    public function editPost($id){
        usersController::isAdminLogged();


        $redirect = new redirectModel();

        $redirect->id = $id;
        $redirect->name = filter_input(INPUT_POST, "name");
        $redirect->url = filter_input(INPUT_POST, "url");
        $redirect->slug = filter_input(INPUT_POST, "slug");
        $redirect->target = filter_input(INPUT_POST, "target");

        $redirect->update();

        header("location: ../list");

    }

    public function delete($id){
        usersController::isAdminLogged();

        $redirect = new redirectModel();
        $redirect->id = $id;

        $redirect->delete();

        header("location: ../list");
    }

    public function stats(){
        $redirect = new redirectModel();

        $stats = $redirect->getStats();

        $number = $redirect->getNumberOfLines();

        $redirect->getTotalClicks();

        view('redirect', 'stats.admin', ["redirect" => $redirect, "stats" => $stats, "number" => $number], 'admin');
    }

    /* //////////////////// PUBLIC //////////////////// */

    //Redirect
    public function redirect($url, $slug){

        $core = new coreController();

        $redirect = new redirectModel();

        $redirect->fetchWithSlug($slug);

        $redirect->redirect($redirect->id);



    }

}