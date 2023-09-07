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
		<title>users</title>
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
						<?php
							include('menu.php');
						?>
					</div>
				</div>
			</div>
		</div>
		
				<div class="table_block">
				<div class="table_box">
				<div class="table_area"> 
				<div class="table"> 
			<?php
			
			echo '<a href="add-user.php">Add</a>';
			echo '<table>
			<caption><br>USERS<br></caption>
			<tr>
			<th>Name</th>
			<th>email</th>
			<th>Action</th>
			</tr>';
			$stmt = $db->query('SELECT userID, username, email, password, lawlevel, clan , clan_rating, guild, money, food, level, saphir, date, lang, experience FROM users_data ORDER BY username');
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td>'.$row['username'].'</td>';
				echo '<td>'.$row['email'].'</td>';
				?>
				
				<td> <a href="edit-user.php?id=<?php echo $row['userID'];?>">Edit</a>
				<?php if($row['userID'] != 1){?>
					| <a href="javascript:deluser('<?php echo $row['userID'];?>','<?php echo $row['username'];?>')">Delete</a>
					
				<?php } ?>
				</td>
				
				<?php
					echo '</tr>';
					
				}
				echo '</table>';
			?>
			</div>
			</div>
			</div>
			</div>
			<div class="table_block">
			<div class="table_box">
			<div class="table_area"> 
			<div class="table"> 
			<?php
				
				echo '<table>
				<caption><br>APPLICATIONS<br></caption>
				<tr>
				<th> 1 - Send link(http://bc.rotary.org.ua/assets/site/php/admin/add-application.php) to person who need to be user in site <br>
				2 - After this in list bottom you see application from this person <br>
				3 - You can change application from this person (EDIT) / delete this application (DELETE) / send to email of this person link for to be  a user (Accept)</th>
				</tr>
				<tr>
				<th>Name</th>
				<th>email</th>
				<th>Action</th>
				</tr>';
				
				$stmt = $db->query('SELECT apID, apname, email, password, date, apcode, lang  FROM ap_data ORDER BY apname');
				while($row = $stmt->fetch()){
					
					echo '<tr>';
					echo '<td>'.$row['apname'].'</td>';
					echo '<td>'.$row['email'].'</td>';
				?>
				
				<td> <a href="edit-application.php?id=<?php echo $row['apID'];?>">Edit</a>
				
				| <a href="javascript:delap('<?php echo $row['apID'];?>','<?php echo $row['apname'];?>')">Delete</a>
				
				
				</td>
				
				<?php
					echo '</tr>';
					
				}
				echo '</table>';
			?>
			</div>
			</div>
			</div>
			</div>
			
			<script language="JavaScript" type="text/javascript">
			function deluser(id, title)
			{
				if (confirm("Are you sure you want to delete '" + title + "'"))
				{
					window.location.href = 'users.php?deluser=' + id;
				}
			}
			function delap(id, title)
			{
				if (confirm("Are you sure you want to delete '" + title + "'"))
				{
					window.location.href = 'users.php?delap=' + id;
				}
			}
			
			
			</script>
			
			<script src="../../js/jquery-3.5.1.min.js"></script>
			<script src="../../js/scripts.js"></script>
			</body>
			</html>	
			<?php
				if(isset($_GET['deluser'])){
					
					//if user id is 1 ignore
					if($_GET['deluser'] != '1'){
						
						$stmt = $db->prepare('DELETE FROM users_data WHERE userID = :userID');
						$stmt->execute(array(':userID' => $_GET['deluser']));
						
						header('Location: users.php?action=deleted');
						exit;
						
					}
				}
				if(isset($_GET['delap'])){    
					$stmt = $db->prepare('DELETE FROM ap_data WHERE apID = :apID');
					$stmt->execute(array(':apID' => $_GET['delap']));
					
					header('Location: users.php?action=deletedap');
					exit;
					
					
				}
				
				
				
				
						