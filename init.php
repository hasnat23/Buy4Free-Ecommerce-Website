<?php
$db = mysqli_connect("localhost","id9432082_root","12345");
if(!$db){
die('Could not Connect: '.mysql_error());
}
mysqli_select_db($connection, "id9432082_redstoneshop");
?>