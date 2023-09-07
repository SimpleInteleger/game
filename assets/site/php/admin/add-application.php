<?php 
	//include config
	require_once('../includes/config.php');
	
	
	//if not logged in redirect to login page
	//if(!$user->is_as_in("admin")){ header('Location: login.php'); }
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
?>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>add application</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<link href="../../css/inside_style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="add_block">
			<div class="add_box">
				<div class="add_area">
					<form action='' method='post' id="add" class="add">
						<p class="input_name"><label>Name</label><br />
						<input type='text' name='apname' value='<?php if(isset($error)){ echo $_POST['apname'];}?>'></p>
						
						<p class="input_password"><label>Password</label><br />
						<input type='password' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>
						
						<p class="input_password"><label>Confirm Password</label><br />
						<input type='password' name='passwordConfirm' value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>'></p>
						
						<p class="input_email"><label>Email</label><br />
						<input type='text' name='email' value='<?php if(isset($error)){ echo $_POST['email'];}?>'></p>
						
						<p class="input"><input type='submit' name='submit' value='Add Application'></p>
						
					</form>
				</div>
			</div>
		</div>
		<script src="../../js/jquery-3.5.1.min.js"></script>
		<script src="../../js/scripts.js"></script>
	</body>
</html>	

<?php
	if(isset($_POST['submit'])){
		if($_POST['password'] == $_POST['passwordConfirm']){
			try {
				
				//insert into database
				$stmt = $db->prepare('INSERT INTO ap_data (apname, email, password, date, apcode, lang) VALUES (:apname, :email, :password, :date, :apcode, :lang)');
				$stmt->execute(array(
				':apname' => $_POST['apname'], 
				':email' => $_POST['email'], 
				':password' => $_POST['password'], 
				':date' => date('Y-m-d H:i:s'), 
				':apcode' => generateRandomString(), 
				':lang' => "RUS"
				));
				
				//redirect to index page
				header('Location: ../../../../index.php');
				exit;
				
				} catch (PDOException $e){
				echo $e->getMessage();
			}
			}else{
			echo "<p class='res_password' style='position: fixed; top: 0px; width: 100%;'><label>passwords different</label></p>";}
	}	
	
