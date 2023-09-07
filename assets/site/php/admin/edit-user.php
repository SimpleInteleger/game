<?php 
	//include config
	require_once('../includes/config.php');
	
	
	//if not logged in redirect to login page
	if(!$user->is_as_in("admin")){ header('Location: login.php'); }
	
	try{
		
		$stmt = $db->prepare('SELECT userID, username, email, password, lawlevel, clan , clan_rating, guild, money, food, level, saphir, date, lang, experience FROM users_data WHERE userID = :userID');
		$stmt->execute(array(':userID' => $_GET['id']));
		$row = $stmt->fetch();
		
		} catch(PDOException $e) {
		echo $e->getMessage();
	}
?>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>edit user</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<link href="../../css/inside_style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<div class="menu_block fix_for_lists">
			<div class="menu_box">
				<div class="menu_area">
					<div class="menu_s">
						<ul id='adminmenu'>
							<!--  <li><a href='index.php'>Blog</a></li>-->
							<li><a href='users.php'>EXIT</a></li> 
						</ul>
						<div class='clear'></div>
						<hr />
					</div>
				</div>
			</div>
		</div>
		<div class="edit_block">
			<div class="edit_box">
				<div class="edit_area">
					<form action='' method='post' id="edit" class="edit">
						<input type='hidden' name='userID' value='<?php echo $row['userID'];?>'>
				
						<p class="input_name"><label>Username</label><br />
						<input type='text' name='username' value='<?php echo $row['username'];?>'></p>
						
						<p class="input_password"><label>Password (only to change)</label><br />
						<input type='password' name='password' value='<?php echo $row['password'];?>'></p>
						
						<p class="input_email"><label>Email</label><br />
						<input type='email' name='email' value='<?php echo $row['email'];?>'></p>
						
						<p class="input_name"><label>Lawlevel</label><br />
						<input type='text' name='lawlevel' value='<?php echo $row['lawlevel'];?>'></p>
						
						<p class="input_name"><label>Clan</label><br />
						<input type='text' name='clan' value='<?php echo $row['clan'];?>'></p>
						
						<p class="input_name"><label>Clan_rating</label><br />
						<input type='text' name='clan_rating' value='<?php echo $row['clan_rating'];?>'></p>
						
						<p class="input_name"><label>Guild</label><br />
						<input type='text' name='guild' value='<?php echo $row['guild'];?>'></p>
						
						<p class="input_name"><label>Money</label><br />
						<input type='number' name='money' value='<?php echo $row['money'];?>'></p>
						
						<p class="input_name"><label>Food</label><br />
						<input type='number' name='food' value='<?php echo $row['food'];?>'></p>
						
						<p class="input_name"><label>Saphir</label><br />
						<input type='number' name='saphir' value='<?php echo $row['saphir'];?>'></p>
						
						<p class="input_name"><label>Experience</label><br />
						<input type='number' name='experience' value='<?php echo $row['experience'];?>'></p>
						
						<p class="input_name"><label>Level</label><br />
						<input type='number' name='level' value='<?php echo $row['level'];?>'></p>
						
						<p class="input_name"><label>date</label><br />
						<input type='date' name='data' value='<?php echo $row['data'];?>'></p>
						
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
	$password =  $_POST['password'];
	if( strlen($password) > 0){
    
    if($password ==''){
        $error[] = 'Please enter the password.';
	}
    
    
	}
	
	if(!isset($password)){
    
    //$hashedpassword = $user->create_hash($password);
    
    //update into database
    $stmt = $db->prepare('UPDATE users_data SET userID = :userID, username = :username, email = :email, password = :password, lawlevel = :lawlevel, clan = :clan , clan_rating = :clan_rating, guild = :guild, money = :money, food = :food, level = :level, saphir = :saphir, date = :date, lang = :lang, experience = :experience WHERE userID = :userID');
    $stmt->execute(array(
	':username' => $_POST['username'], 
	':email' => $_POST['email'], 
	':password' => $_POST['password'], 
	':lawlevel' => $_POST['lawlevel'], 
	':clan' => $_POST['clan'] , 
	':clan_rating' => $_POST['clan_rating'], 
	':guild' => $_POST['guild'], 
	':money' => $_POST['money'], 
	':food' => $_POST['food'], 
	':level' => $_POST['level'], 
	':saphir' => $_POST['saphir'], 
	':date' => date('Y-m-d H:i:s'), 
	':lang' => "RUS", 
	':experience' => $_POST['experience'],
    ':userID' => $_POST['userID']
	
    ));
	
    
    
	} else {
    
     $stmt = $db->prepare('UPDATE users_data SET userID = :userID, username = :username, email = :email, lawlevel = :lawlevel, clan = :clan , clan_rating = :clan_rating, guild = :guild, money = :money, food = :food, level = :level, saphir = :saphir, date = :date, lang = :lang, experience = :experience WHERE userID = :userID');
    $stmt->execute(array(
	':username' => $_POST['username'], 
	':email' => $_POST['email'], 
	
	':lawlevel' => $_POST['lawlevel'], 
	':clan' => $_POST['clan'] , 
	':clan_rating' => $_POST['clan_rating'], 
	':guild' => $_POST['guild'], 
	':money' => $_POST['money'], 
	':food' => $_POST['food'], 
	':level' => $_POST['level'], 
	':saphir' => $_POST['saphir'], 
	':date' => date('Y-m-d H:i:s'), 
	':lang' => "RUS", 
	':experience' => $_POST['experience'],
    ':userID' => $_POST['userID']
	
    ));
	
	
	}
	
	header('Location: users.php?action=update');
    exit;
	}	