<?php

// use Gregwar\Captcha\CaptchaBuilder;

class LoginModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function login() {

        if ( !isset($_POST['user_name']) OR empty($_POST['user_name']) ) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
            return false;
        }
        if ( !isset($_POST['user_password']) OR empty($_POST['user_password']) ) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
            return false;
        }


        $sth = $this->db->prepare("SELECT id, login, password, role FROM Users WHERE login = :login");
        $sth->execute(array(':login' => strip_tags($_POST['user_name'])) );
        $count = $sth->rowCount();
        
		
        if ( $count != 1 ) {
            $_SESSION["feedback_negative"][] = FEEDBACK_LOGIN_FAILED;
            return false;
        }

        $result = $sth->fetch();

        if ( !password_verify(strip_tags($_POST['user_password']), $result->password )) {
            $_SESSION["feedback_negative"][] = FEEDBACK_LOGIN_FAILED;
            return false;
/* 				return $result->password; */
        }

        $sth = $this->db->prepare("SELECT name, view, edit, UserRoles.write FROM UserRoles WHERE id = :role");
        $sth->execute(array(':role' => $result->role));
        $access = $sth->fetch();
		
		
        Session::init();
        Session::set('user_logged_in', true);
        Session::set('user_id', $result->id);
        Session::set('user_name', $result->login);
        Session::set('role', $access->name);
        Session::set('canWrite', $access->write);
        Session::set('canView', $access->view);
        Session::set('canEdit', $access->edit);


/*        if ( isset($_POST['user_rememberme']) ) {

            $random_token = hash('sha256', mt_rand());

*/
        
        return true;
    } 

    public function logout() {

        setcookie('rememberme', false, time() - (3600 * 3650), '/', COOKIE_DOMAIN);

        Session::destroy();
    }

    public function isUserLoggedIn() {
        return Session::get('user_logged_in');
    }

    public function registerNewUser() {
	
        if (empty($_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_FIELD_EMPTY;
        } elseif (empty($_POST['user_password_new']) OR empty($_POST['user_password_repeat'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_FIELD_EMPTY;
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_REPEAT_WRONG;
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $_SESSION["feedback_negative"][] = FEEDBACK_PASSWORD_TOO_SHORT;
        } elseif (strlen($_POST['user_name']) > 64 OR strlen($_POST['user_name']) < 2) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG;
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN;
        } elseif (!empty($_POST['user_name'])
            AND strlen($_POST['user_name']) <= 64
            AND strlen($_POST['user_name']) >= 2
            AND preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            AND !empty($_POST['user_password_new'])
            AND !empty($_POST['user_password_repeat'])
            AND ($_POST['user_password_new'] === $_POST['user_password_repeat'])) {
				

            // clean the input
            $user_name = strip_tags($_POST['user_name']);
            // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4,
            
            $user_password_hash = password_hash($_POST['user_password_new'], PASSWORD_DEFAULT);

            // check if username already exists
            $query = $this->db->prepare("SELECT * FROM Users WHERE login = :user_name");
            $query->execute(array(':user_name' => $user_name));
            $count =  $query->rowCount();
            if ($count == 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_USERNAME_ALREADY_TAKEN;
                return false;
            }

            // generate random hash for email verification (40 char string)
            $user_activation_hash = sha1(uniqid(mt_rand(), true));
            // generate integer-timestamp for saving of account-creating date

            // write new users data into database
            $sql = "INSERT INTO Users (login, password, role)
                    VALUES (:login, :password, :role)";
            $query = $this->db->prepare($sql);
            // change role for manager or admin
            $query->execute(array(':login' => $user_name,
                                  ':password' => $user_password_hash,
                                  ':role' => 1));
            $count =  $query->rowCount();
            if ($count != 1) {
                $_SESSION["feedback_negative"][] = FEEDBACK_ACCOUNT_CREATION_FAILED;
                return false;
            } else {
                $_SESSION["feedback_negative"][] = FEEDBACK_UNKNOWN_ERROR;
        }
        // default return, returns only true of really successful (see above)
        return false;
    }
}

}
