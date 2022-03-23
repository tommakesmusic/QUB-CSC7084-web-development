<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once 'html/header.html';
?>


<div class="top">
  <div class="top-left">
  <p id="welcome">Welcome to the <strong>Favourite 500</strong></p><hr />
  <p>BROWSE THE CHART!!</p>
  <p>By itself this list of the albums in the chart is not so useful, so why not try a search aimed at refining what you see, such as "All the beatles albums", or albums that can be considered "Psychedelic Rock"?<br />
  Hopefully you will find more to the site than a static list of albums!</p>
  <p>The full list of albums is here so you can browse and see if anything catches your fancy. You can also sign up and add your own comments or review to each of the albums!</p>
  </div>
  <div class="top-right">
     <img src="img/atlantic-bg-crop.png" alt="Atlantic records label from the 1960s">

  </div>


</div>
<div class="middle">
  <h1> All the albums </h1>
  <hr />
<?php
  require_once "php/all_albums.php";
?>
</div>


<div class="bottom">Thank you for scrolling this far!</div>

<?php
require_once 'html/footer.html';
?>