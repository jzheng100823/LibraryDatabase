<?php
    include 'header.php';
    include 'footer.php';
?>

<!DOCTYPE html>
<html>
<div id="login_button">
        <button onclick= "location.href='login.php'">Staff login</button>
</div>
<br><br><br>
<div class="homepage">
    <h1 class="blue">Bookstore Home Page</h1>
    <h2 class="catelog">Search our catelog:</h2>
    <div class="searchbox">
        <form action = "search.php" method="POST">
            <input type="text" name="search" placeholder="Search">
            <button type="submit" name="submit-search">Search</button>
        </form>
    </div>
    <br>
    <h3>Current books in stock:</h3>
</div>
<div class="book_list">
     <?php
        $sql = "SELECT * FROM book";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);

        if ($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<a href='page.php?book_id=".$row['book_id']."&publisher_id=".$row['publisher_id']."'><li>".$row['title']."</li></a> <br>";
            }
        }
     ?>
</div>
</body>
</html>