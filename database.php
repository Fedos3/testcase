
<?php
 
define ("HOST", "localhost");
define ("USER", "f0750118_lots");
define ("PASS", "admin");
define ("DB", "f0750118_lots");
 
$connect = @mysqli_connect(HOST, USER, PASS, DB) or die ('Не получилось из-за @mysqli_connect :(');
mysqli_set_charset ($connect, 'utf8') or die ('Не получилось из-за mysql_set_charset :(');
 
?>