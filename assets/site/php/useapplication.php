<?php
	require_once('includes/config.php');
	
	try{
		
		$stmt = $db->prepare('SELECT apID, apname, email, password, date, apcode, lang FROM ap_data WHERE apID = :apID');
		$stmt->execute(array(':apID' => $_GET['acceptid']));
		$row = $stmt->fetch();
		
		} catch(PDOException $e) {
		echo $e->getMessage();
	}
	
	
	$date_BD = strtotime($row['date']);
	
	
	
	$date_now = strtotime(date('Y-m-d'));
	$diff = $date_BD - $date_now;

	
	if ($row['apcode'] == $_GET['code']) {
		try {
			
			//insert into database
			$stmt = $db->prepare('INSERT INTO users_data (username, email, password, lawlevel, money, food, level, saphir, date, lang, experience) VALUES (:username, :email, :password, :lawlevel, :money, :food, :level, :saphir, :date, :lang, :experience)');
			$stmt->execute(array(
			':username' => $row['apname'], 
			':email' => $row['email'], 
			':password' => $row['password'], 
			':lawlevel' => "player", 
			':money' => "0", 
			':food' => "10000", 
			':level' => "1", 
			':saphir' => "10", 
			':date' => date('Y-m-d H:i:s'), 
			':lang' => $row['lang'], 
			':experience' => "0"
			
			));
			
			//redirect to index page
			
			
			
			} catch (PDOException $e){
			echo $e->getMessage();
		}
		$stmt = $db->prepare('DELETE FROM ap_data WHERE apID = :apID');
        $stmt->execute(array(':apID' =>  $_GET['acceptid']));
		
		header('Location: ../../../../index.html');
        exit;
	}
	
	
?>