<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once 'html/header.html';
?>

<div class="flex">
  <?php
  require_once 'php/apiTestButtons.php';
  ?>
</div>

<article class="content-genre-box content-grid-col-span-2 flow bg-primary-400 text-neutral-100">
  <div class="flex">
    <h2>Album Genres</h2>
  </div>
</article>

<article class="content-genre-box first flow bg-secondary-400 text-neutral-100">
  <div class="flex">
    <h3>Rock</h3>
    <p>Gotta love some rock music! AC/DC, Led Zeppelin, Coldplay!</p>
  </div>
</article>
<article class="content-genre-box flow bg-secondary-500 text-neutral-100">
  <div class="flex">
    <h3>Jazz</h3>
    <p>Feeling 'Kind of Blue'? You need some Miles Davis!
  </div>
</article>
<article class="content-genre-box flow bg-neutral-100 text-secondary-500">
  <div class="flex">
    <h3>Pop</h3>
    <p>Let's talk about pop music!</p>
  </div>
</article>
<article class="content-genre-box flow bg-secondary-500 text-neutral-100">
  <div class="flex">
    <h3>Metal</h3>
    <p>Metal, metal, top of the class!</p>
  </div>
</article>
<article class="content-genre-box last flow bg-primary-400 text-neutral-100">
  <div class="flex">
    <h2>Login for more Genres</h2>
    <p>Lots of text and stuff can go here, probably and this is why it flows onto two lines and stays in one column</p>
  </div>
</article>

<?php
require_once 'html/footer.html';
?>