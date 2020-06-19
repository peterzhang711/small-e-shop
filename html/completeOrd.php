<?php 

require "../sqlHelper.php";
session_set_cookie_params(1800 , '/', '.localhost');
session_start();

$custid=$_SESSION['custid'];

$orderNum=null;
$orderDate=null;
$firstName=null;
$lastName=null;
$address=null;
$email=null;

$sqlHelper=new sqlHelper();
file_put_contents('log.txt',"in validProd page".PHP_EOL, FILE_APPEND);
$sql="select order_table.order_number, order_table.order_date,customer_table2.firstname,customer_table2.secondname,customer_table2.address,customer_table2.phone,customer_table2.email from order_table INNER JOIN customer_table2 ON order_table.customer_id=customer_table2.custid where customer_table2.custid='".$custid."' and order_table.order_status='P'";
file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
// coding to use dql for query
$res=$sqlHelper->execute_dql($sql);
if($res->num_rows!==0){ while($row=$res->fetch_row()){
    $orderNum=$row[0];
    $orderDate=$row[1];
    $firstName=$row[2];
    $lastName=$row[3];
    $address=$row[4];
    $email=$row[6];
}
}


?>
<!DOCTYPE html>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
<meta charset="UTF-8">
<title>Insert title here</title>
<script></script>
</head>
<body>
<script type="text/javascript" src="../scripts/completeOrd.js">


</script>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	Complete Order<br><br>
	<span class="error"></span>
	<table border=1 cellspacing=0 cellpadding=3>
	<tr>
	<td>Order Number</td><td style="width: 200px"><?php echo $orderNum;?></td>
	</tr>
	<tr>
	<td>Order Date</td><td><?php echo $orderDate;?></td>
	</tr>
	<tr>
	<td>Customer Name</td><td><?php echo $firstName." ".$lastName;?></td>
	</tr>
	<tr>
	<td>Customer Address</td><td><?php echo $address;?></td>
	</tr>
	<tr>
	<td>Customer Email Address</td><td><?php echo $email;?></td>
	</tr>
	</table>
	
	
	
	<br>
	
	
	
	<table border=1 cellspacing=0 cellpadding=3>
	<tr>
	<?php 
	
	$custid=$_SESSION['custid'];
	$sql="select orderline_table.order_number, orderline_table.product_code ,orderline_table.product_quantity, orderline_table.product_price, orderline_table.product_des, orderline_table.product_name, order_table.order_date, order_table.customer_id from order_table  INNER JOIN orderline_table  ON order_table.order_number=orderline_table.order_number where customer_id='".$custid."'and order_status='P'";
	file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
	
	$totalAmount=0;
	$sqlHelper=new sqlHelper();
// 	$sql="select * from orderline_table";
	file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
	// coding to use dql for query in ORDER table
	$res=$sqlHelper->execute_dql($sql);
	if($res->num_rows!==0){
	    while($field=$res->fetch_field()){
	        echo "<th>{$field->name}</th>";
	        
	    }
	  
	    echo "<th>line price</th>";
	    while($row=$res->fetch_row()){
	        $linePrice=$row[3]*$row[2];
	        echo "<tr><td>".$row[0]."</td><td> ".$row[1]."</td><td> ".$row[2]."</td><td> ".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$linePrice."</td></tr>";
// 	        echo "<br />";
	        $orderNumber=$row[0];
	        $prodCode=$row[1];
	        $prodQuant=$row[2];
	        $prodPrice=$row[3];
	        $prodDes=$row[4];
	        $prodName=$row[5];
	        $orderDate=$row[6];
	        $customerId=$row[7];
	        $_SESSION['orderNumber']=$orderNumber;
	        
	        $totalAmount=$totalAmount+$row[2]*$row[3];
	    }
	}
	?>
	</tr>
	</table>

	<table>
	
	<tr>
	<td>Total Amount:</td><td><?php echo $totalAmount ?></td>
	
	</tr>
	<br>
	
<tr>
	
	<td><input type="button" name="pay" value="Make a Payment" onClick="custom_close()"/></td>
	
	
</tr>
	</table>

	</form>
	

<?php 
        
     
?>
</body>

</html>