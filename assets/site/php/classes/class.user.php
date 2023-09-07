<?php

class User {
private $db;

public function __construct($db){
    
    $this->db = $db;
}

public function is_logged_in(){
   
    if((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == true)){
        return true;
    }
    return false;
}
public function is_as_in($level){
    if((isset($_SESSION['loggedin'])) && ($_SESSION['loggedin'] == true) && ($_SESSION['level'] == $level)){
        return true;
    }
    return false;
}

private function get_user_hash($username){
    
    try {
        
        $stmt = $this->db->prepare('SELECT userID, username, email, password, lawlevel, clan , clan_rating, guild, money, food, level, saphir, date, lang, experience FROM users_data WHERE username = :username');
        $stmt->execute(array(':username' => $username));
        $data = $stmt->fetch();
        //var_dump($data);
        return $data;

    } catch(PDOException $e) {
        echo '<p class="error">'.$e->getMessage().'</p>';
    }
}

public function login($username,$password){
    
    $hashed = $this->get_user_hash($username);
    
    
    if($password == $hashed['password']){
        

        $_SESSION['loggedin'] = true;
        $_SESSION['userID'] = $hashed['userID'];
        $_SESSION['username'] = $hashed['username'];
		$_SESSION['level'] = $hashed['lawlevel'];
        return true;
    }
    return false;
}

}

