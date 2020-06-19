<?php
session_start();

//validate if there is enough storage

file_put_contents('log.txt',"@@@validate page now".PHP_EOL, FILE_APPEND);

// //read cookie from member Order page for Order Details AND validate in DB, then reset to null
file_put_contents('log.txt',"####cookie in page 1=".$_COOKIE['Title']."\r\n", FILE_APPEND);
// setcookie('Title',"",0,'','localhost');


//set cookie for validation result for use in Member Order and Member page(could be changed to PHP Session)
// setcookie('errorMsg',"nothing wrong",0,'','localhost');
print('正在加载，请稍等...<br>2秒后自动跳转。');

header("Location: valiProd.php");

?>