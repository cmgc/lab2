<?php

class Lab2 extends Controller {
    
    public function __construct() {
        parent::__construct();

        Auth::handleLogin();
    }

    public function index() {

        $lab_model = $this->loadModel('lab2');
        $items = $lab_model->getAllItems();


        require 'application/views/_templates/header.php';
        require 'application/views/lab2/index.php';
        require 'application/views/_templates/footer.php';

    }
    
    public function addItem() {
	    if ( Session::get('canWrite') == 0 ) {
		    header('location: ' . URL . 'error/index');
	    }
	    
	    $lab_model = $this->loadModel('Lab2');
	    $isSuccess = $lab_model->addItem();
	    
	    if ( $isSuccess ) {
	    	header('location: ' . URL . 'lab2/index');
	    } else {
	    	header('location: ' . URL . 'error/index');
	    }
	    	
    }
    
    public function delete() {
    	
    	if ( Session::get('canEdit') == 0 ) {
	    	header('location: ' . URL . 'error/index');
    	}
    	if ( empty($_POST['id'])) {
	    	header('location: ' . URL . 'error/index');
    	}
    	$id = strip_tags($_POST['id']);
	    $lab_model = $this->loadModel('lab2');
	    $lab_model->deleteById($id);
		
		header('location: ' . URL . 'lab2/index');
    }
}
