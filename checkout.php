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
        $sqlAll = "SELECT item_id, title, price FROM purchased";
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
            $currentbook = $rowAll['item_id'];
            echo "<div class='checkout_books'>
            <h4><li>".$rowAll['title']."</li></h4>&nbsp;&nbsp;<form method='POST'><input type='submit' name='".$currentbook."' value='X'></form>
            <p style='color:green'>Price: $".$rowAll['price']."</p>
            </div>";
            //echo "Current book is: " .$currentbook;
            if(isset($_POST[$currentbook])) {
                echo "You deleted book ".$currentbook;
                $sqlDelBook = $conn->prepare("DELETE from purchased WHERE item_id='$currentbook'");
                $sqlDelBook->execute();
                header("Location: checkout.php");
                //echo " Titled: ".$rowAll['title'];
                //foreach ($_POST['removebook']) {
                //    $stmt = $conn->prepare("DELETE from purchased WHERE book_id='$rowAll[book_id]'");
                //    $stmt->execute();
                //}
                //header("Location: complete.php");
            
            }
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
            $stmt = $conn->prepare("CALL ClearCart"); //ClearCart Procedure
            $stmt->execute();
            header("Location: complete.php");
        }
    ?>
</footer>
</html>