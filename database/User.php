<?php
@session_start();

class User {

    /*
     * function to check if form was submitted ok
     * return errors if found any
     */
    public static function testSignIn() {
        $err = '';
        if ((empty($_POST['username'])) || (empty($_POST['password']))) {
            $err = "Please fill in all the form";
        } else {
            $user = cleanInput($_POST['username']);
            $result = User::getUser($user);
            //if user was not found in database -> create new user
            if ($result) {
                $hash = $result[0]['password'];
                $password = $_POST['password'];
                //before insert the new user check if password match
                if (!password_verify($password, $hash)) {
                    $err = "Password does not match";
                }
            } else {
                $err = "User was not found";
            }
        }
        return $err;
    }

    /**
     * get user params from post
     */
    public static function newUser() {
        $username = 'tami';
        $password = password_hash('1234', PASSWORD_BCRYPT);;
        $name = 'Tami Rotem';
        $auth = 1;
        return User::insertUser($username, $password, $name, $auth);
    }

    /**
     * update a new user to database
     */
    public static function insertUser($username, $password, $name, $auth) {
        $db = new Database();
        $q = "INSERT INTO `adss`.`users` (`username`, `password`, `name`, `auth`) VALUES
             ('{$username}','{$password}', '{$name}', '{$auth}');";
        return $db->createQuery($q);
    }

    /**
     * get user from database
     * return false if was not found
     * @param - $user - a user name to search for
     */
    public static function getUser($user) {
        $db = new Database();
        $q = "SELECT * FROM users WHERE username='{$user}'";
        $result = $db->createQuery($q);
        if (count($result) > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }

}
