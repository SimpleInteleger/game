<?php 
//include config
require_once('../includes/config.php');


//if not logged in redirect to login page
//if(!$user->is_logged_in()){ header('Location: login.php'); }
?>


<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>login admin</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<link href="../../css/inside_style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login_block">
			<div class="login_box">
				<div class="login_area">
					<form action="" method="post" id="login" class="login">
						<p class="input_name"><label>Username</label><input type="text" name="username" value=""  /></p>
						<p class="input_password"><label>Password</label><input type="password" name="password" value="" /></p>
						<p class="input"><label></label><input type="submit" name="submit" value="login" /></p>
						
					</form>
				</div>
			</div>
		</div>
		<script src="../../js/jquery-3.5.1.min.js"></script>
		<script src="../../js/scripts.js"></script>
	</body>
</html>	

<?php
$log=false;

//precess login form if submitted
if(isset($_POST['submit'])){
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if($user->login($username,$password)){
        $log=true;
        echo "start";
        
		
        echo "end";
    
        //logged is return to index page
        header('Location: index.php');
        exit;
        
        
    } else {
        $message = '<p class="error">Wrong username or password</p>';
    }

}//end if submit
if($log){
    
}
if (isset($message)){ echo $message; }
?>