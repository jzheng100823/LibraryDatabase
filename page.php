<?php
    include 'header.php';
    include 'footer.php';
?>

<h1>Book</h1>

<div class="Books">
     <?php
        $bookid = mysqli_real_escape_string($conn, $_GET['book_id']);
        $publisherid = mysqli_real_escape_string($conn, $_GET['publisher_id']);

        $sql = "SELECT * FROM book NATURAL JOIN author where book_id = '$bookid'";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);

        $sqlPublisher = "SELECT pub_name, location from publisher where publisher_id = '$publisherid'";
        $resultPublisher = mysqli_query($conn, $sqlPublisher);
        while($pubrow = mysqli_fetch_assoc($resultPublisher)){
            $pubname = $pubrow['pub_name'];
            $publocation = $pubrow['location'];
        }

        $sqlBook = "SELECT image_path from book where book_id = '$bookid'";
        $resultBook = mysqli_query($conn, $sqlBook);
        while($bookrow = mysqli_fetch_assoc($resultBook)) {
            $bookcover = $bookrow['image_path'];
        }
        //echo $bookcover;
        ?>
        <div class="container">
            <img src="<?php echo $bookcover; ?>" alt="cover">
        </div>
        <?php
        //print($pubname);
        //print($publocation);
        if ($queryResults > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='book_data'>
                    <h3>".$row['title']."</h3>
                    <p>Author: ".$row['first_name']. "&nbsp;" .$row['last_name']."<p>
                    <p style='color:green'>Price: $".$row['price']."</p>
                    <p>Year: ".$row['publish_year']."<p>
                    <br>
                    <h4>Publisher:</h4>
                    <p>Name: ".$pubname."<p>
                    <p>Location: ".$publocation."<p>
                </div>";
                $booktitle = $row['title'];
                $bookprice = $row['price'];
            }
        }
        else echo "something is broken"
     ?>
</div>
    <div id="home_button">
        <button onclick= "location.href='./'">Return Home</button>
    </div>
    <br><br>
    <div class="add_to_cart">
        <form method="POST">
            <input type="submit" name="addbook" value="Add To Cart">
        </form>
    </div>
    <?php
        if(isset($_POST['addbook'])) {
            echo "&emsp;&emsp;You purchased this book!";
            $stmt = $conn->prepare("INSERT into purchased values ('$bookid','$booktitle','$bookprice')");
            $stmt->execute();
        }
    ?>
</body>
</html>