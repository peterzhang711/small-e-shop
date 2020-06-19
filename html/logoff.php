<?php
session_start();
file_put_contents('log.txt',"in logout page"."\r\n", FILE_APPEND);
$link=mysqli_connect("localhost", "root", "1234");


// Check connection
if (mysqli_connect_errno())
{//failed in connection
      file_put_contents('log.txt',"error in db connection in logoff page=".mysqli_connect_error()."\r\n", FILE_APPEND);
}
//still linking to DB
else{
    file_put_contents('log.txt',"ib linked still ok=".mysqli_connect_error()."\r\n", FILE_APPEND);
    mysqli_close ( $link  );
}

session_destroy();

session_unset();
setcookie('loginUser','',0,'/','localhost');
header("Location: ../index.php");

?>