<?php
// phpcs give one error if we have no doc comment
// but many if we get it wrong
session_start();
require_once '../html/headerSubFolder.html';
require_once "../php/helpers.php";

//if (isset($_SESSION['user'])){
    //$userName = $_SESSION(['user']);

    
    echo <<<EOD
    <div class="top">
        <div class="top-left">
            <p id="welcome">Hello!</p><p>Registered users can search the Favourite 500! Please enter a search below:</p>
            <p>Note: You cannot search for more than one category at a time!</p>
        </div>
        <div class="top-right">
            <img src="../img/records.png" alt="An image of several vinyl records">
        </div>
    </div>
    <div class="middle">
        <div class=contentSearch">

            <div class="content-genre-box content-grid-col-span-2 flow bg-primary-400 text-neutral-100">
                <div class="flex">
                    <h2>SEARCH THE DATABASE</h2>
                </div>
            </div>
            <div class="flex flow">
                <form class="content-genre-box first flow bg-secondary-400 text-neutral-100" action="searchResult.php" autocomplete="off" method="GET">
                        <div class="input-box.label"><label for="value"> Search Chart Position</label></div>
                        <div class="input-box.input"><input type="number" name="value" id="value" autocomplete="off" pattern="[0-9]+" minlength="1" maxlength="3" required></div>
                        <input type="hidden" id="action" name="action" value="position">
                        <button class="stdButton" id="submit" type="submit" value="Search">Search Position</button>
                </form>
            </div>

            <div class="flex flow">
                <form class="content-genre-box flow bg-secondary-500 text-neutral-100" action="searchResult.php" autocomplete="off" method="GET">
                    <div class="input-box.label"><label for="value"> Search Year</label></div>
                    <div class="input-box.input"><input type="number" name="value" id="value" autocomplete="off" pattern="[0-9]+" minlength="1" maxlength="3" required></div>
                    <input type="hidden" id="action" name="action" value="year">
                    <button class="stdButton" id="submit" type="submit" value="Search">Search Year</button>
                </form>  
            </div>
            
            <div class="flex flow">
                <form class="content-genre-box flow bg-neutral-100 text-secondary-500" action="searchResult.php" autocomplete="off" method="GET">
                    <div class="input-box.label"><label for="value">Search Album Name</label></div>
                    <div class="input-box.input"><input type="text" name="value" id="value" autocomplete="off" pattern="[ a-zA-Z0-9!]+" minlength="3" maxlength="30" required></div>
                    <input type="hidden" id="action" name="action" value="album">
                    <button class="stdButton" id="submit" type="submit" value="Search">Search Album Name</button>
                </form>
            </div>


            <div class="flex flow">
                <form class="content-genre-box flow bg-secondary-500 text-neutral-100" action="searchResult.php" autocomplete="off" method="GET">
                    <div class="input-box.label"><label for="value">Search Artist Name</label></div>
                    <div class="input-box.input"><input type="text" name="value" id="value" autocomplete="off" pattern="[ a-zA-Z0-9!/]+" minlength="3" maxlength="30" required></div>
                    <input type="hidden" id="action" name="action" value="artist">
                    <button class="stdButton" id="submit" type="submit" value="Search">Search Artist Name</button>
                </form>
            </div>


            <div class="flex flow">
                <form class="content-genre-box flow bg-neutral-100 text-secondary-500" action="searchResult.php" autocomplete="off" method="GET">
                <div class="input-box.label"><label for="value">Search Genre</label></div>
                <div class="input-box.input"><input type="text" name="value" id="value" autocomplete="off" pattern="[ a-zA-Z0-9/]+" minlength="3" maxlength="30" required></div>
                <input type="hidden" id="action" name="action" value="genre">
                <button class="stdButton" id="submit" type="submit" value="Search">Search Genre</button>
                </form>
            </div>

            <div class="flex flow">
                <form class="content-genre-box last flow bg-primary-400 text-neutral-100" action="searchResult.php" autocomplete="off" method="GET">
                <div class="input-box.label"><label for="value">Search Subgenre</label></div>
                <div class="input-box.input"><input type="text" name="value" id="value" autocomplete="off" pattern="[ a-zA-Z0-9/]+" minlength="3" maxlength="30" required></div>
                <input type="hidden" id="action" name="action" value="subgenre">
                <button class="stdButton" id="submit" type="submit" value="Search">Search Subgenre</button>
                </form>
            </div>
        </div>
    </div>

    <div class="bottom">
    <p>Remember, only members can search and comment!</p>
    </div>
EOD;
/* }
else {
    alertMessage(400, "Can't do stuff If you're not logged in!");
    //header("location: ../index.php");
    echo "<script> location.href='../index.php'; </script>";
} */
require_once '../html/footerSubFolder.html';
?>