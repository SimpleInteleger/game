<?php //include config
require_once('../includes/config.php');


//if not logged in redirect to login page
if($user->is_logged_in()){  
?>
<h1>Menu</h1>
<p>Logged in as <?=$_SESSION['username'];?></p>
<ul id='adminmenu'>
  <!--  <li><a href='index.php'>Blog</a></li>-->
    <li><a href='users.php'>Users</a></li>
    <?php if($user->is_logged_in()){?>
    <li><a href='logout.php'>Logout</a></li>
    <?php } ?>
</ul>
<div class='clear'></div>
<hr />
<?php }