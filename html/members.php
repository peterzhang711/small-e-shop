<?php 
require "../sqlHelper.php";
    session_set_cookie_params(1800 , '/', '.localhost');
    session_start();
    file_put_contents('log.txt',"im member page now"."\r\n", FILE_APPEND);
//     file_put_contents('log.txt',"login user cookie in member page=".$_COOKIE["loginUser"]."\r\n", FILE_APPEND);
    if (empty($_SESSION['loginUser'])){
        file_put_contents('log.txt',"no auth to view member page"."\r\n", FILE_APPEND);
             header("Location: login.php?errno=2");
     }
     
     file_put_contents('log.txt',"cust id=".($_SESSION['custid'])."\r\n", FILE_APPEND);
     $custid=$_SESSION['custid'];
     
     //to get the total count of bought items
     $itemCount=1;
     $sqlHelper=new sqlHelper();
     $sql="select SUM(product_quantity) from orderline_table where order_number = (select order_number from order_table where customer_id = '".$custid."' and order_status='P')";
     file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
     // coding to use dql for query in ORDERLine table
     $res=$sqlHelper->execute_dql($sql);
//      if($res->num_rows>0){
     if ($res->num_rows==false){
         $itemCount=0;
         file_put_contents('log.txt',"it's 0"."\r\n", FILE_APPEND);
     }
     else{
         //sum of quantity exists
         while($row=$res->fetch_row()){
             file_put_contents('log.txt',"row[0] for total quantity=".$row[0]."\r\n", FILE_APPEND);
             if ($row[0]==null){
                 $itemCount=0;
             }
             else{
                 $itemCount=$row[0];
             }
            
         }
     }

    
     
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta http-equiv="refresh" content="3">
<meta name="keyword" content="ceramics,pottery,clay,bazaar ceramics,gallery">

<title>Bazaar Ceramics - Members</title>
    <link rel="stylesheet" href="../css/members.css">
    <link rel="stylesheet" href="../css/style.css">
<script>
onbeforeunload="window.location='logout.php'"
</script>    
</head>
<style>
.error {color: #FF0000;
margin-left: 60px;}


<?php include '../CSS/include/header_css.inc'; ?>
<?php include '../CSS/include/footer.inc'; ?>

</style>
<body>
<?php include 'include/header_html.inc';
if(!($_COOKIE["payStatus"]) ==null){
    //it means the confirm button is pressed, time to set order to 'COMPLETE' status
    $payStatus=$_COOKIE["payStatus"];
    file_put_contents('log.txt',"payStatus in member page=".$payStatus."\r\n", FILE_APPEND);
    //reset cookie to null ONLY after updating DB
    
    
    $sqlHelper=new sqlHelper();
    $sql="update order_table set order_status='C'  where order_status='P' and customer_id='".$custid."'";
    file_put_contents('log.txt',"sql=".$sql."\r\n", FILE_APPEND);
    $res=$sqlHelper->execute_dml($sql);
    if($res==0){
        //DB update error
        file_put_contents('log.txt',"set order to Completed status failed".PHP_EOL, FILE_APPEND);
    }
    else {
        //DB update successfully
        file_put_contents('log.txt',"set order to Completed status successfully".PHP_EOL, FILE_APPEND);
        setcookie('payStatus',"",null,'','localhost');
    }
    
    }    
?>
<div id="Banner" >
</div>
<div id="content" class="content">
    <div class="disCount">Discounted Items
    <!-- <a href="displayOrd.php">|Items In Cart|</a><br> -->
    <br>
     <span class="error"> <?php echo $itemCount." item";?></span>
    <a href="#" onclick="window.open('//localhost/Bazaar_Ceramics_ss/html/displayOrd.php', 'mywin'); return false;">|Items In Cart|</a><br>
     <!-- <span class="error"> <?php echo $errorMsg;?></span> -->
     <!-- <span class="error"> <?php echo $itemCount." item pending payment";?></span> -->
    </div>
    
    <table>
        <tr>
            <td>
                <!--<a href="members_order.php?pic=bcpot002&title=Red Bowl1&des=Shallow Copper Red bowl form showing distinctive qualities of this traditional reduction fired glaze&price=450" target="win1">  -->
                <a href="members_order.php?pic=bcpot002&title=Red Bowl&des=Shallow Copper Red bowl form showing distinctive qualities of this traditional reduction fired glaze&price=450" target="win1">
                <img class="wraparound1" src="../images/bcpot002_smaller.jpg" alt="Copper Red Bowl"/>
                </a>
                <p class="wraparound">Copper Red Bowl-$450</p >
            </td>
            <td>
                <a href="members_order.php?pic=bcpot006&title=Chun Bowl&des=Blue Chun bowl with tea stain rim over terracotta&price=350" target="win1">
                <img class="wraparound1" src="../images/bcpot006_smaller.jpg" alt="Chun Bowl"/>
                </a>
                <p class="wraparound">Chun Bowl-$350</p >
            </td>
            <td>
                <a href="members_order.php?pic=bcpot010&title=Moonscapr Bowl&des=High Calcium bowl with white glaze over blue slip&price=320" target="win1">
                <img class="wraparound1" src="../images/bcpot010_smaller.jpg" alt="Moonscapr Bowl"/>
                </a>
                <p class="wraparound">Moonscapr Bowl-$320</p >
            </td>
        </tr>
        <tr>
            <td>
                <a href="members_order.php?pic=bcpot014&title=Carved Vase 001&des=Carved Iron stoneware vase form Oxidation lustre on rim&price=450" target="win1">
                <img class="wraparound2" src="../images/bcpot014_smaller.jpg" alt="Carved Vase 001"/>
                </a>
                <p class="wraparound">Carved Vase 001-$450</p >
            </td>
            <td>
                <a href="members_order.php?pic=bcpot016&title=Carved Vase 002&des=Carved dry matt calcium vase form&price=450" target="win1">
                <img class="wraparound2" src="../images/bcpot016_smaller.jpg" alt="Carved Vase"/>
                </a>
                <p class="wraparound">Carved Vase 002-$450</p >
            </td>
            <td>
                <a href="members_order.php?pic=bcpot020&title=Copper Red Dish&des=Shallow Copper Red dish form showing distinctive qualities of this traditional reduction fired glaze&price=450" target="win1">
                <img class="wraparound3" src="../images/bcpot020_smaller.jpg" alt="Copper Red Dish"/>
                </a>
                <br>
                <br>
                <p class="wraparound">Copper Red Dish-$450</p >
            </td>
        </tr>
    </table>

</div>
    <!--Footer section-->
    <?php include 'include/footer.inc'?>
</body>
</html>