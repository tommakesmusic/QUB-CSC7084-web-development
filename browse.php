<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once 'html/header.html';
?>
<div class="top">
  <div class="top-left">
  <p id="welcome">Welcome to the <strong>Favourite 500</strong></p><hr />
  <p>A collection of the favourite 500 albums as voted by the public!</p>
  </div>

  <div class="top-right">
    <?php
    require_once 'php/userButtons.php';
  ?>
</div>

</div>
<div class="content">
  <?php
    require_once "php/all_records.php";
  ?>
</div>

<div class="bottom">THIS IS THE BOTTOM AREA</div>

<?php
require_once 'html/footer.html';
?>