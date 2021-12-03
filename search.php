<?php
    include 'header.php';
?>

<h1>Search page</h1>

<div class="Books">
<?php
    if(isset($_POST['submit-search'])){
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        //$sql = "SELECT * FROM book WHERE book.title LIKE '%$search%' or author.first_name LIKE '%$search%'or author.last_name LIKE '%$search%'";
        $sql = "SELECT * FROM book NATURAL JOIN author WHERE book.title LIKE '%$search%' or author.first_name LIKE '%$search%' or author.last_name LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result); //number of records returned
        
        echo "There are ".$queryResult." results!";

        if($queryResult > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<a href='page.php?book_id=".$row['book_id']."&publisher_id=".$row['publisher_id']."'><div class='Books_list'>
                    <h3>".$row['title']."</h3>
                    <p>".$row['first_name']."&nbsp;" .$row['last_name']."</p>
                    <p>".$row['price']."<p>
                </div></a>";
            }
        } else{
            echo "There are no results matching your search!";
        }
    }
?>
</div>