<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once 'html/header.html';
?>


<div class="top">
  <div class="top-right">
  <p id="welcome">Welcome to the <strong>Favourite 500</strong></p><hr />
  <p>BROWSE THE CHART!!</p>
  </div>
  <div class="top-left">
    

  </div>


</div>
<div class="middle">
  <h1> About this project </h1>
  <hr />
 <p> This project has been created to fulfill the educational aims of QUB web assignment</p>
<?php
  require_once "php/all_records.php";
?>
</div>


<div class="bottom">THIS IS THE BOTTOM AREA</div>

<?php
require_once 'html/footer.html';
?>