<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
require_once 'html/header.html';
?>


<div class="top">
  <div class="top-left">
  <p id="welcome">Welcome to the <strong>Favourite 500</strong></p><hr />
  <p>A collection of the favourite 500 albums of all time as curated by <a href="https://www.rollingstone.com/" target="_blank">Rolling Stone Magazine!</a></p>
  <p>You might agree with their choices, or disagree, but explore and leave your comment and let us know what you think!</p>
  <p>This dataset has been supplied via <a href ="https://www.kaggle.com" target="_blank">Kaggle.</a></p>
  <P>Rolling Stone say <blockquote cite=" https://www.rollingstone.com/music/music-lists/best-albums-of-all-time-1062063/"><h4>..no list is definitive — tastes change, new genres emerge, the history of music keeps being rewritten.</h4></blockquote> but if you love music you will find something to talk about on this list.</p>
  </div>
 
  <div class="top-right">
    <img src="img/records.png" alt="An image of several vinyl records">
  </div>

</div>
<div class="middle">


<div class="content">

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
    <p>Lots of text and stuff can go here, probably and this is why it flows onto two lines and stays in one column. It's really just demonstrating the responsive css grid properties.</p>
  </div>
</article>
</div>
</div>

<div class="bottom"><p>THIS IS THE BOTTOM AREA - It isn't used for much but it is here!</p></div>

<?php
require_once 'html/footer.html';
?>