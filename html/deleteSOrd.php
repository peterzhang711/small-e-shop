<?php 

require "../sqlHelper.php";
session_set_cookie_params(1800 , '/', '.localhost');
session_start();

// echo "delete Order";
echo "Your shopping cart is empty now";
$orderNumber=$_SESSION['orderNumber'];

$sqlHelper=new sqlHelper();
$sql="DELETE FROM order_table WHERE order_number='".$orderNumber."'";
file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
$res=$sqlHelper->execute_dml($sql);
if($res==1){
//     echo "delete order successfully";
    file_put_contents('log.txt',"delete order successfully".PHP_EOL, FILE_APPEND);
}
else {
    //DB insertion error
//     echo "failed in delete orderline table";
    file_put_contents('log.txt',"failed in delete orderline table".PHP_EOL, FILE_APPEND);
    
}

echo "<script>window.close();</script>"

?>