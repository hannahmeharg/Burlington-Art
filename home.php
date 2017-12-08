 <?php
include ('top.php');
?>
<article id="main">
        
    <title>Burlington Art</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<style>
.mySlides {display: none;}
</style>
<body>


<div class="home photos" style="max-width:1000px">
  <img class="mySlides" src="home1.jpg" style="width:100%">
  <img class="mySlides" src="home2.jpg" style="width:100%">
  <img class="mySlides" src="home3.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
    
<h1><strong>About Us</strong></h1>

        <h2>Hannah Meharg</h2>
          <figure>
              <img src="../final/hannah.jpg" alt="" class="hannah">
              <figcaption>Hi! My name is Hannah Meharg. I am a sophomore at UVM studying computer science and data science. Although I am studying technology, I have always had a love for art. In order to keep me sane with a full cs course load, I am a gallery guard at UVM’s Fleming Museum. I have found my time there very peaceful and enjoyable and a time to take a step back from technology. Last year, I was so fortunate to see the works of Basquiat, Andy Warhol, and Keith Haring, three of my favorite artists, all in one exhibition at Flemings. Another favorite artist of mine is Yayoi Kusama. One of her famous Infinity Mirror was just installed at the David Wirner gallery in NYC and I am very excited to see it when I get home. 
</figcaption>
           </figure>
        
        <h2>Evan Ray</h2>
             <figure>
                 <img src="../final/evan.jpg" alt="" class="hannah">
                 <figcaption>Hi my name is Evan!

I am one of the three elite founders of the Burlington Art webpage! I have had a passion for art for as long as I can remember. Both of my parents are artist so I was raised with all different types of art surrounding me. My father, Richard Ray, makes his living creating and selling a hybrid of photographs and paintings. He uses his paintings combined with photographs, edits the colors and saturation of the pieces, then sells high quality prints of the finished product. My mother, Marjorie Ray, is very proficient in fiber artist. She has taught classes at my old middle school and does custom work when requested. She does everything you can think of in fiber arts including knitting, embroidering, quilting and more! I personally have a passion for music making, but that does not hinder my love for visual arts! Me and my associates created this page to promote local art galleries and museums and give something back to the amazing Burlington art community. I hope you enjoy our site!</figcaption>
            </figure>
        
        <h2>Natasha Geffen</h2>
          <figure>
              <img src="../final/natasha.JPG" alt="" class="hannah">
              <figcaption>Hey, welcome to our site! My name is Natasha and I study Psychology at the University of Vermont with minors in Computer Science and Applied Design. My favorite type of art is digital art - anything from web design to graphics to computerized animation. My hope is to use my combined knowledge in psychology, computer science, and design to influence people through digital art. Long before I knew how to use Photoshop I would spend my days cutting up magazines and making collages. My parents, who have both always been involved in the performing arts, passed down their love for creativity to me. I am grateful for the many art supplies and artist biographies my parents provided me with while growing up. I will always have a passion for art and will continue seeking out local artists in my community wherever I go!</figcaption>
          </figure>
</article>
<?php
include "footer.php";
?>
    </body>
</html>
