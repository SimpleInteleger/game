<?php require_once('../includes/config.php');


//if not logged in redirect to login page
if(!$user->is_as_in("admin")){ header('Location: login.php'); }
?>
<!DOCTYPE html>
<html lang="ua">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>admin panel</title>
		<meta name="viewport" content="width=device-width">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		
		<link href="../../css/style.css" rel="stylesheet" type="text/css">
		<link href="../../css/inside_style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
<!--<a href="add-post.php">Add</a>
<table>
    <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
	-->
    <?php
    try {
        
        $stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
        while($row = $stmt->fetch()){
            
          //  echo '<tr>';
          //  echo '<td>'.$row['postTitle'].'</td>';
          //  echo '<td>'.date('jS M Y', strtotime($row['postDate'])).'</td>';
            ?>
    <!--
            <td>
                <a href="edit-post.php?id=<?php echo $row['postID'];?>">Edit</a> |
                <a href="javascript:delpost('<?php echo  $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
            </td>
            -->
            <?php
            //echo '</tr>';
            
        }
        
    } catch(PDOException $e) {
      //  echo $e->getMessage();
    }
    ?>
    <!--
</table>
-->

<script language="JavaScript" type="text/javascript">
    function delpost(id, title)
    {
        if (confirm("Are you sure you want to delete '" + title + "'"))
            {
                window.location.href = 'index.php?delpost=' + id;
            }
			}
</script>

<?php 
if(isset($_GET['delpost'])){
    
    $stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID');
    $stmt->execute(array(':postID' => $_GET['delpost']));
    
    ?><?php header('Location: index.php?action=deleted');?><?php
}

if(isset($_GET['action'])){
    echo '<h3>Post '.$_GET['action'].'.</h3>';
}
?>
<div class="menu_block">
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


<script src="../../js/jquery-3.5.1.min.js"></script>
		<script src="../../js/scripts.js"></script>
	</body>
</html>	