<?php
if(!function_exists('e')){
    function e($string){
        if($string){
            return htmlspecialchars($string);
        }
    }
}

if(!function_exists('get_session')){
    function get_session($key){
        if($key){
            return !empty($_SESSION[$key])
                ? e($_SESSION[$key])
                : null;
        }
    }
}

if(!function_exists('is_logged_in')){
    function is_logged_in(){
            return isset($_SESSION['user_id']) || isset($_SESSION['name']);
    }
}
if(!function_exists('get_avatar_url')){
    function get_avatar_url($email){
        return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))));

    }
}

if(!function_exists('find_user_by_id')){
    function find_user_by_id($id){
        global $db;

        $q = $db->prepare('SELECT client_type, client_title, client_name, client_surname, client_email, client_cell, client_city, client_address, client_password  FROM client WHERE client_id = ?');
        $q->execute([$id]);

        $data = $q->fetch(PDO:: FETCH_OBJ);
        $q->closeCursor();

        return $data;
    }
}
if(!function_exists('find_minion_by_id')){
    function find_minion_by_id($minionid){
        global $db;

        $q = $db->prepare('SELECT minion_title, minion_name, minion_surname, minion_race, minion_gender, minion_age, minion_cell, minion_nationality, minion_email, minion_password, minion_idNum, minion_passportNum, minion_address, minion_city, minion_suburb, minion_hiredDate, Users FROM minion WHERE minion_id = ?');
        $q->execute([$minionid]);

        $data = $q->fetch(PDO:: FETCH_OBJ);
        $q->closeCursor();

        return $data;
    }
}


if(!function_exists('not_empty')){
    function not_empty($fields = []){
        if(count($fields)!=0){
            foreach($fields as $field){
                if(empty($_POST[$field]) || trim($_POST[$field])== ""){
                    return false;
                }
            }
            return true;
        }
    }
}

if(!function_exists('is_already_in_use')){
    function is_already_in_use($field,$value,$table){
        global $db;

        $q = $db->prepare("SELECT client_id FROM $table WHERE $field = ?");
        $q->execute([$value]);

        $count = $q->rowCount();

        $q->closeCursor();

        return $count;
    }
}

if(!function_exists('has_already_applied')){
    function has_already_applied($field,$value,$table){
        global $db;

        $q = $db->prepare("SELECT applicant_id FROM $table WHERE $field = ?");
        $q->execute([$value]);

        $count = $q->rowCount();

        $q->closeCursor();

        return $count;
    }
}

if(!function_exists('set_flash')){
    function set_flash($message, $type = 'info'){
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;

    }
}

if(!function_exists('redirect')){
    function redirect($page){
        header('location:'.$page);
        exit();
    }
}

if(!function_exists('save_input_data')){
    function save_input_data(){
        foreach ($_POST as $key => $value) {
            if(strpos($key,'password')=== false){
                $_SESSION['input'][$key] = $value;
            }
       }
    }
}

if(!function_exists('save_applicant_data')){
    function save_applicant_data(){
        foreach ($_POST as $key => $value) {
                $_SESSION['input'][$key] = $value;
        }
    }
}

if(!function_exists('get_input')){
    function get_input($key){
        if(!empty($_SESSION['input'][$key])){
            return $_SESSION['input'][$key];
        }else {
            return null;
        }

    }
}

if(!function_exists('clear_input_data')){
    function clear_input_data(){
        if(isset($_SESSION['input'])){
             $_SESSION['input']=[];
        }
    }
}

if(!function_exists('set_active')){
    function set_active($file){
        $page = array_pop(explode('/', $_SERVER['SCRIPT_NAME']));

        if($page == $file.'.php'){
            return "active";
        }else{
            return "";
        }
    }
}