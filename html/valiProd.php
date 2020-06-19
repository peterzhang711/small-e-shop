<?php
require "../sqlHelper.php";
session_set_cookie_params(1800 , '/', '.localhost');
session_start();

file_put_contents('log.txt',"in validProd page"."\r\n", FILE_APPEND);

$URL=$_SESSION['URL'];
file_put_contents('log.txt',"URL=".$URL."\r\n", FILE_APPEND);
// header("refresh:2;url=members_order.php?pic=bcpot002&title=Red%20Bowl&des=Shallow%20Copper%20Red%20bowl%20form%20showing%20distinctive%20qualities%20of%20this%20traditional%20reduction%20fired%20glaze&price=450");
header("refresh:0.5;url=".$URL);

//read cookie from member Order page for Order Details AND validate in DB, then reset to null
file_put_contents('log.txt',"## in validProd page".PHP_EOL, FILE_APPEND);
file_put_contents('log.txt',"####cookie1 in validProd table=".$_COOKIE['prodCode']."\r\n", FILE_APPEND);

$prod=$_COOKIE['prodCode'];
$title=$_COOKIE['title'];
$item_Description=$_COOKIE['Item_Description'];
$quantity=$_COOKIE['Quantity'];
$price=$_COOKIE['Price'];
$total_price=$_COOKIE['Total_price'];


$sqlHelper=new sqlHelper();
file_put_contents('log.txt',"in validProd page".PHP_EOL, FILE_APPEND);
$sql="select * from product_table where product_code='".$prod."'";
file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
// coding to use dql for query
$res=$sqlHelper->execute_dql($sql);

if($res->num_rows!==0){
    //product exists in product table, get storage
    while($row=$res->fetch_row()){
        file_put_contents('log.txt',"row[0]=".$row[0]."\r\n", FILE_APPEND);
        file_put_contents('log.txt',"row[1]=".$row[1]."\r\n", FILE_APPEND);
        $prodStorage=$row[2];
        
        if ($prodStorage>$quantity){
            file_put_contents('log.txt',"enough storage".PHP_EOL, FILE_APPEND);
            //positive result, enough storage
            
            $storageLeft=($prodStorage-$quantity);
            file_put_contents('log.txt',"prodStorage=".$prodStorage."\r\n", FILE_APPEND);
            file_put_contents('log.txt',"quantity=".$quantity."\r\n", FILE_APPEND);
            file_put_contents('log.txt',"storageLeft=".$storageLeft."\r\n", FILE_APPEND);
            //minus storage from storage table
            $sql="update product_table set product_storage='".$storageLeft."'  where product_code='".$prod."'";
            file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
            $res=$sqlHelper->execute_dml($sql);
            if($res==0){
                //DB insertion error 
                echo "failed in insert member table";
                $_SESSION['storageResult']="DB insertion error";    
                
            }
            else {
                //minus successfully
//                 $_SESSION['storageResult']="Congratulations, the order has been made successfully";      
                file_put_contents('log.txt',"minus storage successfully".PHP_EOL, FILE_APPEND);
                
                //start to insert order/orderline table
                //step 1: test if it's an existing order or not, if YES, get the ORDER number of the existing order. if NO, get MAX for current, create a new order
                $custid=$_SESSION['custid'];
                $sql="select * from order_table where customer_id='".$custid."'and order_status='P'";
                file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
                // coding to use dql for query in ORDER table
                $res=$sqlHelper->execute_dql($sql);
                                if($res->num_rows!==0){
                                    //order exists in order table, get the order ID
                                    while($row=$res->fetch_row()){
                                        file_put_contents('log.txt',"row[0] is order number=".$row[0]."\r\n", FILE_APPEND);
                                        
                                        $orderNumber=$row[0];
                                //step 2: (pending)if existin in the existing orderLine, update existing order line
                                //search if the existing orderline is with the same product or not
                                        $sql="select * from orderline_table where order_number='".$orderNumber."'";
                                        file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
                                        $res=$sqlHelper->execute_dql($sql);
                                        if($res->num_rows!==0){
                                            $existProdFound=false;
                                            //orderline exists with the same ordre number, check if the same product has been bought before or not
                                            while($row=$res->fetch_row()){
                                                //if same prod exist
                                                file_put_contents('log.txt',"row[2] is prod code from order=".$row[2]."\r\n", FILE_APPEND);
                                                file_put_contents('log.txt',"row[3] is quantity from order=".$row[3]."\r\n", FILE_APPEND);
                                                $existingProdCode=$row[2];
                                                $existingQuan=$row[3];
                                                if ($existingProdCode==$prod){
                                                    $existProdFound=true;
                                                    $accumQuantity=$existingQuan+$quantity;
                                                    $sql="update orderline_table set product_quantity='".$accumQuantity."' where order_number= '".$orderNumber."' and product_code='".$prod."'";
                                                    file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
                                                    $res=$sqlHelper->execute_dml($sql);
                                                    if($res==0){
                                                        echo "failed in updating quantity for orderline table";
                                                        $_SESSION['storageResult']="failed in updating quantity for orderline table";
                                                        file_put_contents('log.txt',"failed in updating quantity for orderline table".PHP_EOL, FILE_APPEND);
                                                        
                                                    }
                                                    else {
                                                        if($res==1){
                                                            
//                                                          /*  */$_SESSION['storageResult']="Your item is in the shopping cart now. You can place more items here or close this page to purchase other products.";
                                                            file_put_contents('log.txt',"a new item has been added to your existing order successfully".PHP_EOL, FILE_APPEND);
                                                            file_put_contents('log.txt',"i am there".PHP_EOL, FILE_APPEND);
                                                            echo '<script type="text/javascript">window.close();</script>';
                                                        }
                                                        else{
                                                            echo "no records are affected in the orderline table";
                                                            $_SESSION['storageResult']="no records are affected in the orderline table";
                                                            file_put_contents('log.txt',"no records are affected in the orderline table".PHP_EOL, FILE_APPEND);
                                                           
                                                        }
                                                        file_put_contents('log.txt',"i am here0".PHP_EOL, FILE_APPEND);
                                                    }   
                                                    
                                                    file_put_contents('log.txt',"i am here1".PHP_EOL, FILE_APPEND);
                                                }
                                                
                                                
                                                
                                            }
                                            if ($existProdFound==false){
                                                //no existing orderline with same prod found, create the order line
                                                $sql="insert into orderline_table (orderline_number,order_number,product_code,product_quantity,product_price,product_des,product_name) values (null,'$orderNumber','$prod','$quantity','$price','$item_Description','$title')";
                                                file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
                                                
                                                //insert into orderline table
                                                $res=$sqlHelper->execute_dml($sql);
                                                if($res==1){
//                                                     $_SESSION['storageResult']="Your item is in the shopping cart now. You can place more items here or close this page to purchase other products.";
                                                    file_put_contents('log.txt',"insert orderline ok".PHP_EOL, FILE_APPEND);
                                                    echo '<script type="text/javascript">window.close();</script>';
                                                }
                                                else {
                                                    //DB insertion error or no rows affected
                                                    $_SESSION['storageResult']="shopping cart/orderline table DB insertion error";
                                                    file_put_contents('log.txt',"insert orderline not ok".PHP_EOL, FILE_APPEND);
                                                    
                                                }
                                                
                                            }
                                        }
                                        file_put_contents('log.txt',"i am here15".PHP_EOL, FILE_APPEND);
                                    }
                                                               
                                                       }
                                else{
                                    //order not exists in order table, create a new order , then create orderline as well
                                    //get the max index in order table first
                                    $sql="select max(order_number) from order_table";
                                    $res=$sqlHelper->execute_dql($sql);
                                    
                                    while($row=mysqli_fetch_row($res)){
                                        foreach($row as $key=> $val){
                                            $maxOrderId=$val;
                                            $nextOrderId=$maxOrderId+1;
                                            $_SESSION['nextOrderId']=$nextOrderId;
                                            $date=date("Y-m-d");
                                            $sql="insert into order_table (order_number,customer_id,order_status,order_date) values ('$nextOrderId','$custid','P','$date')";
                                            file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
                                            //insert into order table
                                            $res=$sqlHelper->execute_dml($sql);
                                            if($res==0){
                                                //order DB insertion error
                                                echo "failed in insert member table";
                                                $_SESSION['storageResult']="can't insert a new order/order table DB insertion error";
                                                
                                            }
                                            else {
                                                //order table insert successfully, contintue to insert orderline table
                                                $sql="insert into orderline_table (orderline_number,order_number,product_code,product_quantity,product_price,product_des,product_name) values (null,'$nextOrderId','$prod','$quantity','$price','$item_Description','$title')";
                                                file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
                                                
                                                //insert into orderline table
                                                $res=$sqlHelper->execute_dml($sql);
                                                if($res==1){
//                                                     $_SESSION['storageResult']="Your item is in the shopping cart now. You can place more items here or close this page to purchase other products.";
                                                    
                                                    echo '<script type="text/javascript">window.close();</script>';
                                                    file_put_contents('log.txt',"insert orderline ok".PHP_EOL, FILE_APPEND);
                                                             }
                                                else {
                                                    //DB insertion error or no rows affected
                                                    $_SESSION['storageResult']="can't update your existing order";
                                                    
                                                    file_put_contents('log.txt',"insert orderline not ok".PHP_EOL, FILE_APPEND);
                                                }
                                                
                                            }
                                        }             
                                                                          
                                                                        }
                                    }
                                    
                                    file_put_contents('log.txt',"i am here2".PHP_EOL, FILE_APPEND);
                 }
        }
        else{
            //not enough storage
            $_SESSION['storageResult']="not enough storage, please modify and try again";  
            
        }
    
    file_put_contents('log.txt',"alive1".PHP_EOL, FILE_APPEND);
    }
}

else{
    //product not exists in table,
    $_SESSION['storageResult']="can't find this product in DB, DB error";   
    
}
$res->free();




// setcookie('Title',"",0,'','localhost');


?>


