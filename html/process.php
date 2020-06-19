<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Production process</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/process.css">
</head>
<style>
<?php include '../CSS/include/header_css.inc'; ?>
<?php include '../CSS/include/footer.inc'; ?>
</style>
<body>
<?php include 'include/header_html.inc'?>
    <section class="process-text">
        <h2>Production Process</h2>
        <p>Bazaar Ceramics are constantly experimenting with new designs and techniques.  The process of developing a particular range of ceramics, starts with the design process.  The ceramic designers and gallery director meet regularly to discuss new ideas for product ranges.  It may be that the designers are following through on an inspiration from a field trip or perhaps the gallery director has some suggestions to make based on feedback from customers.</p>
        <p>Promising designs are developed into working drawings which the production potters use to create the ceramic forms.  Depending on the type of decoration, the designers may apply the decoration at this stage, or after they have been bisqued (fired to 1000 degrees celsius).  These prototype designs go through a lengthy development stage of testing and review until the designer is happy with the finished product.  At this stage a limited number of pots are produced and displayed in the gallery.  If they do well in the gallery, they become a standard line.  </p>
    </section>
    <!--<div id="process">-->
        <!--<div class="processtop"></div>-->
    <!-- Container for the image gallery -->
    <div class="container">

        <!-- Full-width images with number text -->
        <div class="mySlides">
            <div class="numbertext">1 / 6</div>
            <img src="../processimages/openingclay1.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <div class="numbertext">2 / 6</div>
            <img src="../processimages/sequence2.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <div class="numbertext">3 / 6</div>
            <img src="../processimages/sequence3.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <div class="numbertext">4 / 6</div>
            <img src="../processimages/sequence4.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <div class="numbertext">5 / 6</div>
            <img src="../processimages/finishing5.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <div class="numbertext">6 / 6</div>
            <img src="../processimages/finishing6.jpg" style="width:100%">
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <!-- Image text -->
        <div class="caption-container">
            <p id="caption"></p>
        </div>

        <!-- Thumbnail images -->
        <div class="row">
            <div class="column">
                <img class="demo cursor" src="../processimages/openingclay1small.jpg" style="width:100%" onclick="currentSlide(1)" alt="Production Starting">
            </div>
            <div class="column">
                <img class="demo cursor" src="../processimages/sequence2small.jpg" style="width:100%" onclick="currentSlide(2)" alt="Production Setting">
            </div>
            <div class="column">
                <img class="demo cursor" src="../processimages/sequence3small.jpg" style="width:100%" onclick="currentSlide(3)" alt="Production Building">
            </div>
            <div class="column">
                <img class="demo cursor" src="../processimages/sequence4small.jpg" style="width:100%" onclick="currentSlide(4)" alt="Production Thinning">
            </div>
            <div class="column">
                <img class="demo cursor" src="../processimages/finishing5small.jpg" style="width:100%" onclick="currentSlide(5)" alt="Production Smoothing">
            </div>
            <div class="column">
                <img class="demo cursor" src="../processimages/finishing6small.jpg" style="width:100%" onclick="currentSlide(6)" alt="Production Finishing">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../scripts/process.js"></script>
  
</body>
</html>