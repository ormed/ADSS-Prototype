<?php
@session_start();
include_once 'C:\wamp\www\ADSS-Prototype\help_functions.php';

class Notification {

    /**
     * function to check if edit form was submitted ok
     * return errors if found any
     */
    public static function testEdit() {
        $err = '';
        if(isset($_POST['username'])) {
            if(empty($_POST['username']) || empty($_POST['name'])) {
                $err = "Please fill in all the fields.";
                return $err;
            } else {
                $string_exp = "/^[A-Za-z .'-]+$/";
                if (!preg_match($string_exp, $_POST['name'])) {
                    $err = 'The name you entered does not appear to be valid.';
                    return $err;
                }
                if(User::getUser($_POST['username'])) {
                    $err = "Username is already exist.";
                    return $err;
                }
            }
        }
        return $err;
    }

    /**
     * get user params from post
     */
    public static function newUser($username, $pass, $name, $auth) {
        $password = password_hash($pass, PASSWORD_BCRYPT);;
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
     * update user
     * @param - $user->user to update, $name
     */
    public static function updateUser($user, $name) {
        $db = new Database();
        $q = "UPDATE users SET `name`='{$name}' WHERE username = '{$user}'";
        $db->createQuery($q);
    }

    /**
     * get notification from database
     * return false if was not found
     * @param array $id - notification id to search for
     * @return array $result - found notification
     */
    public static function getNotification($id) {
        $db = new Database();
        $q = "SELECT * FROM notifications WHERE id='{$id}'";
        $result = $db->createQuery($q);
        if (count($result) > 0) {
            return $result;
        } else {
            return FALSE;
        }
    }

    /**
     * get all notifications in db
     * @return array $result - all notifications
     */
    public static function getNotifications() {
        $db = new Database();
        $q = "SELECT * FROM notifications";
        $result = $db->createQuery($q);
        return $result;
    }

}
