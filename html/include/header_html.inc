<?php 
session_set_cookie_params(1800 , '/', '.localhost');
session_start();
$firstName=$_SESSION['firstName'];

file_put_contents('html/log.txt',"##header page".PHP_EOL, FILE_APPEND);
file_put_contents('html/log.txt',"##first name session in header include file=".$firstName."\r\n", FILE_APPEND);
file_put_contents('html/log.txt',"###login user cookie in xxx page=".$_COOKIE["loginUser"]."\r\n", FILE_APPEND);
?>

<head>
<!-- <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" /> -->
<link href="../css/include/header_css.inc" rel="stylesheet" type="text/css" />
<!-- <base href="http://localhost:8080/Bazaar_Ceramics_ss/Bazaar_Ceramics_ss/html/"/> -->
</head>
<header id="header">
    <div class="center">
<!--         <h1 class="logo">Bazaar Ceramic</h1> -->
        <nav class="link" >
            <!-- <h2 class="none">navigator</h2> -->
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li class="dropdown"><a href="About_Us.php" >About Us+</a>
                    <div  class="ddc">
                        <a href="company_bg.php">History</a>
                        <!--<a href="html/design.php">Design</a>-->
                        <a href="process.php">Process</a>
                        <a href="company_mission.php">Mission</a>
                    </div>
                </li>
                <li class="dropdown"><a href="Collections.php">Collections</a>
                    <div class="ddc">
                        <a href="members.php">Members</a>
                    </div>
                </li>
                <li><a href="Forms.php">Forms</a></li>
                <li><a href="Contact_Us.php">Contact Us</a></li>
            </ul>
        </nav>
        <a href="http://localhost/Bazaar_Ceramics_ss/html/login.php"><input class="login_but" type="button" value=Login id="logInButton"></a>
        <a href="http://localhost/Bazaar_Ceramics_ss/html/logoff.php"><input class="login_but" type="button" value=Logoff id="logOffButton" ></a>
    <?php 
    
 
//     if (empty($_SESSION['loginUser'])){
//         echo "<script language='javascript'>var change_logOffButton = document.getElementById('logOffButton');
//         change_logOffButton.style.display = 'none';</script>";
//      }
//      else {
//             echo "<script language='javascript'>var change_logInButton = document.getElementById('logInButton');
//             change_logInButton.style.display = 'none';</script>";
//             echo "Hi,".$firstName;
//      }
     
     if(!($_COOKIE["loginUser"]) ==null){
// already logon
         file_put_contents('html/log.txt',"have cookie"."\r\n", FILE_APPEND);
         echo "<script language='javascript'>var change_logInButton = document.getElementById('logInButton');
           change_logInButton.style.display = 'none';</script>";
         echo "Hi,".$_COOKIE["loginUser"];
     }
else {
    //not logon
    echo "<script language='javascript'>var change_logOffButton = document.getElementById('logOffButton');
        change_logOffButton.style.display = 'none';</script>";
}
 ?>
    </div>
    

</header>
<body>
    
    </body>

