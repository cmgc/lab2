<?php

class Blog extends Controller {
	
	function __construct() {
		parent::__construct();
		
		Auth::handleLogin();
	}
	
	function index() {
		$blog_model = $this->loadModel('blog');
		$blogs = $blog_model->getAllItems();
		
		$this->view->render('blog/index');
		
	}
	
	function add_new() {
		$blog_model = $this->loadModel('blog');
		$success = $blog_model->add_new();
		
		if ( $success ) {
			header('location: ' . URL . 'blog/index');
		}	
	}
	
	function delete() {
		
	}
	
	function change() {
		
	}
}