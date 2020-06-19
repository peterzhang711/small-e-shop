 <?php 
    session_start();
    file_put_contents('../log.txt',"no auth to view member order page"."\r\n", FILE_APPEND);
    if (empty($_SESSION['loginUser'])){
             header("Location: login.php?errno=2");
     }
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Members_Order</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
    <style>
    .error {color: #FF0000;}
        body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td
        {margin:0;padding:0;}


        .header{
            display: block;
            margin: 0 auto;
            width: 980px;
            height: 50px;
            background-color: cornsilk;
            text-align: center;
            font-size: large;
        }
        .image_content {
            display: block;
            margin: 0 auto;
            width: 980px;
            height: 650px;
            background-color: cornsilk;
        }

        .form_content{
            display: block;
            margin: 0 auto;
            width: 980px;
            height: 320px;
            background-color: cornsilk;
        }
        .bold{
            font-weight: bold;
        }
        .footer{
            display: block;
            margin: 0 auto;
            width: 980px;
            height: 50px;
            background-color: #bbbcb7;
            text-align: center;
        }
        .footer input{
            height: 50px;
        }
        .photo table img{
            display: block;
            height: 63%;
        }
        img{
            width: 100%;
            height:50%;
        }
        form{
            display:block ;
            width: 850px;
            height: 320px;
            margin: 0 auto;
            margin-bottom: 10px;
        }
        #btnClose{
            color: black;
            font-weight: bold;
            line-height: 50px;
        }
<?php include '../CSS/include/header_css.inc'; ?>
<?php include '../CSS/include/footer.inc'; ?>        
    onbeforeunload="window.location='logout.php'"
    
    </style>



<body >
<header id="header">
<?php include 'include/header_html.inc'?>
</header>

<?php
session_set_cookie_params(1800 , '/', '.localhost');
file_put_contents('log.txt',"in member order page".PHP_EOL, FILE_APPEND);

//save URL in session for validateOrd.php page to redirec back to memberOrder page
$URL=$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
$_SESSION['URL'] = $URL;
file_put_contents('log.txt',"URL in member order page=".$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']."\r\n", FILE_APPEND); 

    $errorMsg=$_SESSION['storageResult'];
    file_put_contents('log.txt',"errorMsg in member order page=".$errorMsg."\r\n", FILE_APPEND);
    //reset cookie to null after use
    //     setcookie('errorMsg',"",0,'','localhost');
    $_SESSION['storageResult']="";

?>
<div class="header">
    <h1 id="head"></h1>
</div>
<div class="image_content">
    <div class="photo" id="myPhoto">
        <!--javascript for red pot photo-->
        <script type="text/javascript" src="../scripts/bcpot.js"></script>
        

</script>
        
    </div>
</div>
<div class="form_content"><br><br>
   <!--  <form action="" method="get" id="ord_input" onsubmit="return sub_Ord();">-->
   <!-- <form action="http://localhost:8080/Bazaar_Ceramics_ss/html/members_order.php" method="get" id="ord_input" > -->
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get" id="ord_input" >
         <!--content in form-->
<!-- 	   <span class="bold">Title:</span><p id="tit">  </p><br><br> -->
		<span class="bold">Title:</span><span id="tit"></span><input id="title" name="title" type="hidden" readonly></input><br><br>   
       <span class="bold">Item Description:</span><span id="des"></span><input type="hidden" id="Item_Description" name="Item_Description" size="99" value="2Shallow Copper Red bowl form showing distinctive qualities of this traditional reduction fired glaze" readonly></input><br><br>
       <span class="bold">Quantity:</span> <input id="qua" name="Quantity" type="text" value="1" >  <span class="error"> <?php echo $errorMsg;?></span>  <br><br>
       <span class="bold">Price:</span><span id="price"></span><input id="pri" name="Price" type="hidden" readonly></input><br><br>
       <span class="bold">Total Price:</span> <input  id="tot" name="Total_price" type="text" readonly><br><br><br>
       <input id="prodCode" name="prodCode" type="hidden" readonly ></input><br><br>
       <!--3 buttons-->
       <input id="btn1" type="reset" value="Clear" onclick="clear_Content()">
       <input id="btn2" type="button" value="Calculate Total " onclick="calculate_total()">
       <!-- <input id="btn3" type="submit" value="Add To Cart" onclick="sub_Ord()" > -->
       <input id="btn3" type="button" value="Add To Cart" onclick="sub_Ord()" >

   </form>
</div>

<div class="footer">
    <!--close button-->
    <a href="javascript" id="btnClose" type="button"  onClick="custom_close()">Close</a>

</div>
<?php
session_start();

file_put_contents('log.txt',"##cookie1 not empty=".$_COOKIE['Title']."\r\n", FILE_APPEND);
file_put_contents('log.txt',"##cookie1 not empty=".$_COOKIE['Item_Description']."\r\n", FILE_APPEND);
file_put_contents('log.txt',"##cookie1 not empty=".$_COOKIE['Quantity']."\r\n", FILE_APPEND);
file_put_contents('log.txt',"##cookie1 not empty=".$_COOKIE['Price']."\r\n", FILE_APPEND);
file_put_contents('log.txt',"##cookie1 not empty=".$_COOKIE['Total_price']."\r\n", FILE_APPEND);

?>

<?php include 'include/footer.inc'?> 
</body>
<script type="text/javascript" src="../scripts/members_order.js">

</script>

</html>