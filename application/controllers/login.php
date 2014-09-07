<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
    }


    function index() {

        $login_model = $this->loadModel('Login');

        $this->view->render('login/index', false, true);
    }

    function login() {
        $login_model = $this->loadModel('Login');
        $login_successfull = $login_model->login();
		
/*
		var_dump($login_successfull);
		exit;
*/
		
        if ( $login_successfull == true) {
            header('location: ' . URL . 'dashboard/index');
        } else {
            header('location: ' . URL . 'login/index');
        }
    }

    function logout() {
        $login_model = $this->loadModel('Login');
        $login_model->logout();
        header('location: ' . URL);
    }
/*
    function loginWithCookie() {
        $login_model = $this->loadModel('Login');
        $login_successfull = $login_model->loginWithCookie();

        if ( $login_successfull ) {
            header('location: ' . URL . 'dashboard/index');
        } else {
            $login_model->deleteCookie();
            header('location: ' . URL . 'login/index');
        }
    }
*/
    function showProfile() {
        Auth::handleLogin();
        $this->view->render('login/showprofile');
    }

    function editUsername() {
        Auth::handleLogin();
        $this->view->render('login/editusername');
    }

    function editUsername_action() {
        Auth::handleLogin();
        $login_model = $this->loadModel('Login');
        $login_model->editUserName();
        $this->view->render('login/editusername');
    }

    function changeAccountType() {
        Auth::handleLogin();
        $this->view->render('login/changeaccounttype');
    }

    function changeAccountType_action() {
         Auth::handleLogin();
         $login_model = $this->loadModel('Login');
         $login_model->changeAccountType();
         $this->view->render('login/changeaccounttype');
    }

    function register() {
        $login_model = $this->loadModel('Login');

        $this->view->render('login/register');
    }

    function register_action() {
        $login_model = $this->loadModel('Login');
        $registration_successful = $login_model->registerNewUser();
		
        if ( $registration_successful ) {
            header('location: ' . URL . 'login/index');
        } else {
            header('location: ' . URL . 'login/register');
        }
    }

    function showCaptcha() {
        $login_model = $this->loadModel('Login');
        $login_model->generateCaptcha();
    }
}
