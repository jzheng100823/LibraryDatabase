<?php
    include 'header.php';
    include 'footer.php';
?>

<h1>Search page</h1>

<!DOCTYPE html>
<html>

<div class="books">
<?php
    if(isset($_POST['submit-search'])){
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        //$sql = "SELECT * FROM book WHERE book.title LIKE '%$search%' or author.first_name LIKE '%$search%'or author.last_name LIKE '%$search%'";
        //$sql = "SELECT * FROM book NATURAL JOIN author WHERE book.title LIKE '%$search%' or author.first_name LIKE '%$search%' or author.last_name LIKE '%$search%'";
        $sql = "SELECT * FROM book NATURAL JOIN author WHERE book.title LIKE '%$search%' OR CONCAT(author.first_name, ' ', author.last_name) LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        //echo "Result is: ". $result;
        $queryResult = mysqli_num_rows($result); //number of records returned
        
        echo "There are ".$queryResult." results!";

        if($queryResult > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<a href='page.php?book_id=".$row['book_id']."&publisher_id=".$row['publisher_id']."'><div class='test2'>
                    <h3>".$row['title']."</h3>
                    <p>".$row['first_name']."&nbsp;" .$row['last_name']."</p>
                    <p>Price: $".$row['price']."<p>
                </div></a>";
            }
        } else{
            echo "<p style='color:red' 'font-size:20px'>There are no results matching your search!</p>";
        }
        echo "<button onclick=\"location.href='./'\">Search again</button>";
    }
?>
</div>