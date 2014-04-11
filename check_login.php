<?php
$sess = session_id();
if ($sess == '') session_start();

$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="cs315_1"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form
$myusername=$_POST['username'];
$mypassword=$_POST['pwd'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$mypassword=md5($mypassword);
$sql="SELECT * FROM users U, email E WHERE U.Uids=E.Uids AND E.Emailids='$myusername' and U.Password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("username");
//session_register("password");
$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['pwd'];
header("location:login_success.php");
}
else {
echo '<script language="javascript">confirm("Wrong Username or Password")</script>';
echo '<script language="javascript">window.location = "http://localhost/login_success.php"</script>';
}
?>