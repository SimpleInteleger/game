<?php 
	//include config
	require_once('../includes/config.php');
	
	
	//if not logged in redirect to login page
	if(!$user->is_as_in("admin")){ header('Location: login.php'); }
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>add user</title>
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
		<div class="add_block">
			<div class="add_box">
				<div class="add_area">
					<form action='' method='post' id="add" class="add">
						
						<p class="input_name"><label>Username</label><br />
						<input type='text' name='username' required></p>
						
						<p class="input_password"><label>Password</label><br />
						<input type='password' name='password' required></p>
						
						<p class="input_email"><label>Email</label><br />
						<input type='email' name='email' required></p>
						
						<p class="input_name"><label>Lawlevel</label><br />
						<input type='text' name='lawlevel' required></p>
						
						<p class="input_name"><label>Clan</label><br />
						<input type='text' name='clan' ></p>
						
						<p class="input_name"><label>Clan_rating</label><br />
						<input type='text' name='clan_rating' ></p>
						
						<p class="input_name"><label>Guild</label><br />
						<input type='text' name='guild' ></p>
						
						<p class="input_name"><label>Money</label><br />
						<input type='number' name='money' value=0></p>
						
						<p class="input_name"><label>Food</label><br />
						<input type='number' name='food' value=0></p>
						
						<p class="input_name"><label>Saphir</label><br />
						<input type='number' name='saphir' value=0></p>
						
						<p class="input_name"><label>Experience</label><br />
						<input type='number' name='experience' value=0></p>
						
						<p class="input_name"><label>Level</label><br />
						<input type='number' name='level' value=1></p>
						
							<p class="input"><input type='submit' name='submit' value='Add User'></p>
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
		try {
			
			//insert into database
			$stmt = $db->prepare('INSERT INTO users_data (username, email, password, lawlevel, clan , clan_rating, guild, money, food, level, saphir, date, lang, experience) VALUES ( :username, :email, :password, :lawlevel, :clan , :clan_rating, :guild, :money, :food, :level, :saphir, :date, :lang, :experience)');
			$stmt->execute(array(
			':username' => $_POST['username'], 
			':email' => $_POST['email'], 
			':password' => $_POST['password'], 
			':lawlevel' => $_POST['lawlevel'], 
			':clan' => $_POST['clan'], 
			':clan_rating' => $_POST['clan_rating'], 
			':guild' => $_POST['guild'], 
			':money' => strval($_POST['money']), 
			':food' => strval($_POST['food']), 
			':level' => strval($_POST['level']), 
			':saphir' => strval($_POST['saphir']), 
			':date' => date('Y-m-d H:i:s'), 
			':lang' => "RUS", 
			':experience' => strval($_POST['experience'])
			));
			
		//redirect to index page
		header('Location: users.php?action=added');
		exit;
		
		} catch (PDOException $e){
		echo $e->getMessage();
		}
		}		