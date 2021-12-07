<?php
include 'header.php';

// Grab User submitted information
$username = $_POST["mailuid"];
$password = $_POST["pwd"];

//Prepare statement for variables username and password to avoid SQL injection
$stmt = $conn->prepare("SELECT username, password FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

//Check result for success and failure echos
$result = mysqli_stmt_get_result($stmt);
$check = mysqli_fetch_array($result);
if(isset($check)){
	?>
    <div class="staffpage">
        <h2>Input the following information to add a book to the database:</h2>
        <form method ="post">
        Book Info: <br>
        <input type = "text" name = "book_id" placeholder="Book ID"> &nbsp;
        <input type = "text" name = "title" placeholder="Title"> &nbsp;
        <input type = "text" name = "publish_year" placeholder="Year Published"> &nbsp;
        <input type = "text" name = "price" placeholder="Price">
        <br><br>
    
        Author Info: <br>
        <input type = "text" name = "author_id" placeholder="Author ID"> &nbsp;
        <input type = "text" name = "first_name" placeholder="First Name"> &nbsp;
        <input type = "text" name = "last_name" placeholder="Last Name"> &nbsp;
        <br><br>

        Publisher Info: <br>
        <input type = "text" name = "publisher_id" placeholder="Publisher ID"> &nbsp;
        <input type = "text" name = "pub_name" placeholder="Name">
        <input type = "text" name = "location" placeholder="Location">
        <br><br>
    
        <input type = "submit" name="newbook" value = "Submit Book">
        <br><br><hr>

        Update Book Price: <br>
        <input type = "text" name = "book_id2" placeholder="Book ID"> &nbsp;
        <input type = "text" name = "price2" placeholder="New Price">
        <br><br>
        <input type = "submit" name="newprice" value = "Submit Price">
        </form><br><br><br>
        <div class="home_button3">
            <button onclick= "location.href='./'">Logout</button>
        </div>
    </div>
    <?php
} else {
    echo "&nbsp;<h2 style='color:red'>Incorrect username/password!</h2>";
    echo "&nbsp;&nbsp;<a href = 'login.php'>Try Again?</a>";
}


if(isset($_POST['newbook'])) {
    $bookid = $_POST["book_id"];
    $title = $_POST["title"];
    $authorid = $_POST["author_id"];
    $authorfname = $_POST["first_name"];
    $authorlname = $_POST["last_name"];
    $pubyear = $_POST["publish_year"];
    $pubid = $_POST["publisher_id"];
    $pubname = $_POST["pub_name"];
    $publocation = $_POST["location"];
    $price = $_POST["price"];
    //echo "book_id: " .$bookid. " title: " .$title. " authorid: " .$authorid. " pubyear: " .$pubyear. " pubid: " .$pubid. " price: " .$price;
    $sqlNewAuthor = $conn->prepare("INSERT INTO author VALUES ('$authorid', '$authorfname', '$authorlname')");
    $sqlNewAuthor->execute();
    $sqlNewPublisher = $conn->prepare("INSERT INTO publisher VALUES ('$pubid', '$pubname', '$publocation')");
    $sqlNewPublisher->execute();
    $sqlNewBook = $conn->prepare("INSERT INTO book VALUES ('$bookid', '$title', '$authorid', '$pubyear', '$pubid', '$price', '')");
    $sqlNewBook->execute();
    header("Location: index.php");
}

if(isset($_POST['newprice'])) {
    $bookid2 = $_POST["book_id2"];
    $price2 = $_POST["price2"];
    $sqlNewPrice = $conn->prepare("UPDATE book SET price = $price2 WHERE book_id = $bookid2");
    $sqlNewPrice->execute();
    header("Location: index.php");
}
?>