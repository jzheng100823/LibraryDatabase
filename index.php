<?php
    include_once 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library Database</title>
            <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <!-- Text -->
        <h1>Library Database Website</h1>

        <div class="test">
            <p>Site is using MySQL and PHP. Books in Database so far:</p>
        </div>

        <?php
            $sql = "SELECT title FROM book;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['title'] , "<br>";
                }
            }
        ?>
        <hr />

    </body>

</html>

