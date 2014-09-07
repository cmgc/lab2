<?php

class View {


    public function render($filename, $render_without_head_and_foot = false, $loginHeader = false) {

        if ( $render_without_head_and_foot ) {
            require VIEWS_PATH . $filename . '.php';
        } elseif ($loginHeader) {
        	require VIEWS_PATH . '_templates/loginHead.php';
        	require VIEWS_PATH . $filename . '.php';
        	require VIEWS_PATH . '_templates/footer.php';
        } else {
            require VIEWS_PATH . '_templates/header.php';
            require VIEWS_PATH . $filename . '.php';
            require VIEWS_PATH . '_templates/footer.php';
        }
    }

    public function renderFeedbackMsg() {

        require VIEWS_PATH . '_templates/feedback.php';

        //Session::set('feedback_positive', null);
        //Session::set('feedback_negative', null);
    }

    public function isActiveController($filename, $nav_controller) {

        $split_filename = explode("/", $filename);
        $active_controller = $split_filename[0];

        if ( $active_controller == $nav_controller ) {
            return true;
        }
        return false;
    }

    public function isActiveAction($filename, $nav_action) {

        $split_filename = explode("/", $filename);
        $active_action = $split_filename[1];

        if ( $active_action == $nav_action ) {
            return true;
        }
        return false;
    }


    public function isActiveControllerAndAction($filename, $nav_cont_act) {

        $split_filename = explode("/", $filename);
        $active_controller = $split_filename[0];
        $active_action = $split_filename[1];

        $split_filename = explode("/", $nav_cont_act);
        $navigation_controller = $split_filename[0];
        $navigation_action = $split_filename[1];

        if ($active_controller == $navigation_controller AND $active_action == $navigation_action) {
            return true;
        }
        return false;
    }
}
