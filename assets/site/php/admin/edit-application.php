<?php 
	//include config
	require_once('../includes/config.php');
	
	
	//if not logged in redirect to login page
	if(!$user->is_as_in("admin")){ header('Location: login.php'); }
	
	try{
		
		$stmt = $db->prepare('SELECT apID, apname, email, password, date, apcode, lang FROM ap_data WHERE apID = :apID');
		$stmt->execute(array(':apID' => $_GET['id']));
		$row = $stmt->fetch();
		
		} catch(PDOException $e) {
		echo $e->getMessage();
	}
?>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>edit application</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<link href="../../css/inside_style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="edit_block">
			<div class="edit_box">
				<div class="edit_area">
					<form action='' method='post' id="edit" class="edit"> 
						<input type='hidden' name='apID' value='<?php echo $row['apID'];?>'>
						
						<p class="input_name"><label>Apname</label><br />
						<input type='text' name='apname' value='<?php echo $row['apname'];?>'></p>
						
						<p class="input_password"><label>Password (only to change)</label><br />
						<input type='password' name='password' value=''></p>
						
						<p class="input_email"><label>Email</label><br />
						<input type='text' name='email' value='<?php echo $row['email'];?>'></p>
						
						
						<p class="input"><input type='submit' name='submit' value='Update User'></p>
						
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
	$password = $_POST['password'];
	if( strlen($password) > 0){
		
		if($password ==''){
			$error[] = 'Please enter the password.';
		}
		
		
    
	}
	
	if(!isset($password)){
    
    //$hashedpassword = $user->create_hash($password);
    
    //update into database
    $stmt = $db->prepare("UPDATE ap_data SET apname = :apname, email = :email, password = :password, date = :date WHERE apID = :apID ");
    $stmt->execute(array(
    ':apname' => $_POST['apname'],
    ':password' => $_POST['password'],
    ':email' => $_POST['email'],
	':date' => date('Y-m-d H:i:s'),
    ':apID' => $_POST['apID']
	
    ));
	
    
    
	} else {
    
    //update datebase
    $stmt = $db->prepare("UPDATE ap_data SET apname = :apname, email = :email , date = :date WHERE apID = :apID ");
    $stmt->execute(array(
    ':apname' => $_POST['apname'],
    ':email' => $_POST['email'],
	':date' => date('Y-m-d'),
    ':apID' => $_POST['apID']
	
    ));
	
	
	}
	
	header('Location: users.php?action=updateap');
    exit;
	}	