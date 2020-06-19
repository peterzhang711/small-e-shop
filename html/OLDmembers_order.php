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

<div class="header">
    <h1 id="head"></h1>
</div>
<div class="image_content">
    <div class="photo" id="myPhoto">
        <!--javascript for red pot photo-->
        <script type="text/javascript" src="../scripts/bcpot.js"></script>
    </div>
</div>
<div class="form_content"><br><br>
   <form action="" method="get" id="ord_input" onsubmit="return sub_Ord();">
       <!--content in form-->
       <span class="bold">Title:</span><span id="tit"></span><input type="hidden" name="Title" value="Red Bowl" readonly><br><br>
       <span class="bold">Item Description:</span><span id="des"></span><input type="hidden" name="Item Description" size="99" value="Shallow Copper Red bowl form showing distinctive qualities of this traditional reduction fired glaze" readonly><br><br>
       <span class="bold">Quantity:</span> <input id="qua" name="Quantity" type="text" value="1" > <br><br>
       <span class="bold">Price:</span><span id="price"></span> <input id="pri" name="Price"  type="hidden" readonly></input><br><br>
       <span class="bold">Total Price:</span> <input  id="tot" name="Total price" type="text" readonly><br><br><br>
       <!--3 buttons-->
       <input id="btn1" type="reset" value="Clear" onclick="clear_Content()">
       <input id="btn2" type="button" value="Calculate Total " onclick="calculate_total()">
       <input id="btn3" type="submit" value="Add To Cart" >

   </form>
</div>

<div class="footer">
    <!--close button-->
    <a href="javascript" id="btnClose" type="button"  onClick="custom_close()">Close</a>

</div>

<?php include 'include/footer.inc'?>
</body>
<script type="text/javascript" src="../scripts/members_order.js"></script>

</html>