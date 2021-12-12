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


        view('redirect', 'add.admin', [], 'admin');
    }

    public function createPost(){
        usersController::isAdminLogged();

        $redirect = new redirectModel();


        if ($redirect->checkName(filter_input(INPUT_POST, "name")) > 0){

            $_SESSION['toaster'][0]['title'] = REDIRECT_TOAST_TITLE_ERROR;
            $_SESSION['toaster'][0]['type'] = "bg-danger";
            $_SESSION['toaster'][0]['body'] = REDIRECT_TOAST_CREATE_ERROR_NAME;

            header("location: ../redirect/add");

        } elseif ($redirect->checkSlug(filter_input(INPUT_POST, "slug")) > 0){

            $_SESSION['toaster'][0]['title'] = REDIRECT_TOAST_TITLE_ERROR;
            $_SESSION['toaster'][0]['type'] = "bg-danger";
            $_SESSION['toaster'][0]['body'] = REDIRECT_TOAST_CREATE_ERROR_SLUG;

            header("location: ../redirect/add");
        }
        else {

            $redirect->name = filter_input(INPUT_POST, "name");
            $redirect->slug = filter_input(INPUT_POST, "slug");
            $redirect->target = filter_input(INPUT_POST, "target");

            $redirect->create();

            $_SESSION['toaster'][0]['title'] = REDIRECT_TOAST_TITLE_SUCCESS;
            $_SESSION['toaster'][0]['type'] = "bg-success";
            $_SESSION['toaster'][0]['body'] = REDIRECT_TOAST_CREATE_SUCCESS;

            header("location: ../redirect/list");
        }

    }

    public function edit($id){
        usersController::isAdminLogged();

        $redirect = new redirectModel();
        $redirect->fetch($id);


        view('redirect', 'edit.admin', ["redirect" => $redirect], 'admin');
    }

    public function editPost($id){
        usersController::isAdminLogged();


        $redirect = new redirectModel();

        $redirect->id = $id;
        $redirect->name = filter_input(INPUT_POST, "name");
        $redirect->slug = filter_input(INPUT_POST, "slug");
        $redirect->target = filter_input(INPUT_POST, "target");

        $redirect->update();

        $_SESSION['toaster'][0]['title'] = REDIRECT_TOAST_TITLE_SUCCESS;
        $_SESSION['toaster'][0]['type'] = "bg-success";
        $_SESSION['toaster'][0]['body'] = REDIRECT_TOAST_EDIT_SUCCESS;

        header("location: ../list");

    }

    public function delete($id){
        usersController::isAdminLogged();

        $redirect = new redirectModel();
        $redirect->id = $id;

        $redirect->delete();

        $_SESSION['toaster'][0]['title'] = REDIRECT_TOAST_TITLE_SUCCESS;
        $_SESSION['toaster'][0]['type'] = "bg-success";
        $_SESSION['toaster'][0]['body'] = REDIRECT_TOAST_DELETE_SUCCESS;

        header("location: ../list");
    }

    public function stats(){
        $redirect = new redirectModel();

        $stats = $redirect->getStats();

        $number = $redirect->getNumberOfLines();

        $redirect->getTotalClicks();

        $redirect->getAllClicks();

        view('redirect', 'stats.admin', ["redirect" => $redirect, "stats" => $stats, "number" => $number], 'admin');
    }

    /* //////////////////// PUBLIC //////////////////// */

    //Redirect
    public function redirect($slug){

        $core = new coreController();

        $redirect = new redirectModel();

        $redirect->fetchWithSlug($slug);

        $redirect->redirect($redirect->id);



    }

}