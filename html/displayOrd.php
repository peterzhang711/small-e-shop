<?php 

require "../sqlHelper.php";
session_set_cookie_params(1800 , '/', '.localhost');
session_start();



?>
<!DOCTYPE html>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<meta charset="UTF-8">
<title>Insert title here</title>
<script language="javascript">
function custom_close(){
	if 
	(confirm("您确定要关闭本页吗？")){
	window.opener=null;
	window.open('','_self');
	window.close();
	}
	else{}
	}

</script>
</head>
<body>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	Your Shopping Cart<br><br>
	<span class="error">*  Please Click Confirm Button to Get Your whole order Details </span>
	<table border=1 cellspacing=0 cellpadding=3>
	<tr>
	<?php 
	//to handle orderline deletion
	if(!empty($_GET['orderLine'])){
	    $orderLine=$_GET['orderLine'];
	    $itemNum=$_GET['itemNum'];
	    $orderNum=$_GET['orderNum'];
	    
	    $sqlHelper=new sqlHelper();
	    $sql="DELETE FROM orderline_table WHERE orderline_number='".$orderLine."'";
	    file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
	    $res=$sqlHelper->execute_dml($sql);
	    if($res==1){

	        file_put_contents('log.txt',"delete order line successfully".PHP_EOL, FILE_APPEND);
	        
	        $sql="select * from orderline_table where order_number='".$orderNum."'";
	        file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
	        $sqlHelper=new sqlHelper();
	        $res=$sqlHelper->execute_dql($sql);
	        if($res->num_rows==0){
	       	    $sql="DELETE FROM order_table WHERE order_number='".$orderNum."'";
	           	file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
	           	$res=$sqlHelper->execute_dml($sql);
	           	if($res==1){
// 	           	    echo "delete orderline successfully; empty shopping cart";
	           	}
	           	
	        }
	        
	    }
	    else {
	        //DB insertion error
// 	        echo "failed in delete orderline table";
	        file_put_contents('log.txt',"failed in delete orderline table".PHP_EOL, FILE_APPEND);
	        
	    }
	    
	}
	
	$custid=$_SESSION['custid'];
	$sql="select orderline_table.orderline_number,orderline_table.order_number, orderline_table.product_code ,orderline_table.product_quantity, orderline_table.product_price, orderline_table.product_des, orderline_table.product_name, order_table.order_date, order_table.customer_id from order_table  INNER JOIN orderline_table  ON order_table.order_number=orderline_table.order_number where customer_id='".$custid."'and order_status='P'";
	file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
	
	$totalAmount=0;
	$itemCount=0;
	$sqlHelper=new sqlHelper();
// 	$sql="select * from orderline_table";
	file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
	// coding to use dql for query in ORDER table
	$res=$sqlHelper->execute_dql($sql);
	if($res->num_rows!==0){
	    while($field=$res->fetch_field()){
	        echo "<th>{$field->name}</th>";
	    }
	    echo "<th>line action</th>";
	    echo "<th>line price</th>";
	    while($row=$res->fetch_row()){
	        $linePrice=$row[3]*$row[4];
	        echo "<tr><td>".$row[0]."</td><td> ".$row[1]."</td><td> ".$row[2]."</td><td> ".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td><a href='displayOrd.php?orderLine={$row[0]}&orderNum={$row[1]}'>Delete an Item</a></td><td>".$linePrice."</td></tr>";
// 	        echo "<br />";
	        $orderNumber=$row[1];
// 	        $prodCode=$row[1];
// 	        $prodQuant=$row[2];
// 	        $prodPrice=$row[3];
// 	        $prodDes=$row[4];
// 	        $prodName=$row[5];
// 	        $orderDate=$row[6];
// 	        $customerId=$row[7];
	        $_SESSION['orderNumber']=$orderNumber;
	        $totalAmount=$totalAmount+$row[3]*$row[4];
	        $itemCount=$itemCount+1;
// 	        setcookie('errorMsg',"nothing wrong",0,'','localhost');
	        setcookie('errorMsg',$itemCount." items are pending your payment",0,'','localhost');
	        
	    }
	}
	else{
	    header("Location: emptyCart.php");
	}
	?>
	</tr>
	</table>
	<br>
	

	</form>
	<table>	
	
	<tr>
	<td>Total Amount:</td><td><?php echo $totalAmount ?></td>
	
	</tr>
	<tr>
	</tr>
<tr>
	<td><input type="button" name="confirm" value="Confirm" onClick="window.location.href='completeOrd.php'" target="win1"/></td>
	<td><input type="button" name="delete" value="Delete Cart" onClick="window.location.href='deleteSOrd.php'"/></td>
	<td><input type="button" name="Close" value="Close" onclick="window.close();return false"/></td>
	</tr>
	
	
</table>



</body>
</html>