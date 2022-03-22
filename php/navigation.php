<nav id="nav">
    <!-- Navbar logo -->
  <div class="nav-header">

      
      <label class="logo"><a href="http://localhost:8888/index.php">The Favourite 500</a></label>
      

  </div>
   
  <!-- responsive navbar toggle button -->
  <input type="checkbox" id="nav-check">
  <div class="nav-btn">
    <label for="nav-check">
      <span></span>
      <span></span>
      <span></span>
    </label>
  </div>
 
  <!-- Navbar items -->
  <div class="nav-links">
    <a href="http://localhost:8888/">Home</a>
    <a href="http://localhost:8888/about.php">About</a>
    <a href="http://localhost:8888/browse.php">Browse</a>
    <a href="http://localhost:8888/api/chartSearch.php">Search</a>
    <?php
      require_once "userButtons.php"
    ?>
    <!-- <button class="loginBtn">Login</button> -->
  </div>
 
</nav>
<!-- <script src="../js/navigation.js"></script> -->