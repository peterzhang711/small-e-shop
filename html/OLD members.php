<?php 
    session_set_cookie_params(1800 , '/', '.localhost');
    session_start();
//     file_put_contents('log.txt',"login user cookie in member page=".$_COOKIE["loginUser"]."\r\n", FILE_APPEND);
    if (empty($_SESSION['loginUser'])){
        file_put_contents('log.txt',"no auth to view member page"."\r\n", FILE_APPEND);
             header("Location: login.php?errno=2");
     }
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta http-equiv="refresh" content="5">
<meta name="keyword" content="ceramics,pottery,clay,bazaar ceramics,gallery">

<title>Bazaar Ceramics - Members</title>
    <link rel="stylesheet" href="../css/members.css">
    <link rel="stylesheet" href="../css/style.css">
<script>
onbeforeunload="window.location='logout.php'"
</script>    
</head>
<style>
<?php include '../CSS/include/header_css.inc'; ?>
<?php include '../CSS/include/footer.inc'; ?>
</style>
<body>
<?php include 'include/header_html.inc'?>
<div id="Banner" >
</div>
<div id="content" class="content">
    <div class="disCount">Discounted Items
    <!-- <a href="login.php">|Items In Cart|</a> -->
    </div>
    
    <table>
        <tr>
            <td>
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