<html>
<body>

Welcome <?php echo $_POST["username"]; ?><br>
Your group ID is: <?php echo $_POST["grp_id"]; ?>

<?php

/* // Display user name and Group Id for the next page */
$user_name = $_POST["username"];
$group_name = $_POST["grp_id"];

/* // Connect to the database */
$db = mysqli_connect('localhost','root','','sql_skills')
							  or die('Error connecting to MySQL server.');
							  
/* fetching group_id to insert from the group name as we are displaying group name in drop-down */


$group_id = mysqli_query($db, "SELECT `group_id` FROM `usergroup` WHERE name ='".$group_name."'") or die('Error in the select query. /n');

$row = mysqli_fetch_array($group_id);

$grp_id = $row['group_id'];

/* // Insert query for group_member table							   */
$a = mysqli_query($db,"INSERT INTO group_member (user_id,group_id,validated_at) values ($user_name, $grp_id, NOW())") or die('BAD SQL.');	
							  
?>

</body>
</html>