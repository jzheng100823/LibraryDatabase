<?php
    include 'header.php';
    include 'footer.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
    <h1>Checkout</h1>
    <div id="home_button2">
        <button onclick= "location.href='./'">Return Home</button>
    </div>
    <?php
        $sqlAll = "SELECT title, price FROM purchased";
        $sqlPriceTotal = "SELECT sum(price) from purchased";
        $sqlCount = "SELECT * from CartSize"; //CartSize is a view
        $resultAll = mysqli_query($conn, $sqlAll);
        $rowAll = $resultAll->fetch_assoc();

        $resultPriceTotal = mysqli_query($conn, $sqlPriceTotal);
        $resultCount = mysqli_query($conn, $sqlCount);
        $rowPriceTotal = $resultPriceTotal->fetch_assoc();
        $rowCount = $resultCount->fetch_assoc();

        foreach ($resultCount as $rowCount) {
            echo "<div class='checkout_books'>
            <p>You have ".$rowCount['COUNT(book_id)']." books in your cart.</p>
            </div>";
        }
        foreach ($resultPriceTotal as $rowPriceTotal) {
            if($rowPriceTotal['sum(price)'] > 0) {
                echo "<div class='checkout_books'>
                <p style='color:blue;size:20px'>Total Amount: $".$rowPriceTotal['sum(price)']."</p>
                </div>";
            }
        }

        foreach ($resultAll as $rowAll) {
            echo "<div class='checkout_books'>
            <h4><li>".$rowAll['title']."</li></h4>
            <p style='color:green'>Price: $".$rowAll['price']."</p>
            </div>";
        }
        
    ?>
</body>
<footer class="footer">
    <!-- <a href='complete.php'><p>Purchase Books!</p></a>; -->
        <!-- <form method="POST" action="complete.php"> -->
    <br>
    <div class="purchase">
        <form method="POST">
            <input type="submit" name="buybook" value="Purchase Books!">
        </form>
    </div>
    <?php
        if(isset($_POST['buybook'])) {
            $stmt = $conn->prepare("DELETE FROM purchased");
            $stmt->execute();
            header("Location: complete.php");
        }
    ?>
</footer>
</html>