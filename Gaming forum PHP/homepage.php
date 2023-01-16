<?php

    include('config/db_connect.php');

    if(isset($_GET['user'])) {  // getting the user that is logged in 
        $username = mysqli_real_escape_string($conn, $_GET['user']);  // setting the user
    }

    $query = "SELECT * FROM idea ORDER BY created_at";   // sql query for returning each idea that is in the database
    $result = mysqli_query($conn, $query);
    $ideas = mysqli_fetch_all($result, MYSQLI_ASSOC);    // putting ideas inside of an array $ideas
    mysqli_free_result($result);
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>

    <div class="container">
        <div class="row">

            <!-- making container for every idea in the database -->
            <?php foreach($ideas as $idea): ?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <img src="img/logo.webp" class="logo">
                    <div class="card-content center">
                        <h6> <?php echo htmlspecialchars($idea['title']); ?> </h6>
                        <p> <?php echo htmlspecialchars($idea['description']); ?></p>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php?id=<?php echo $idea['user'].",".$idea['id'].",".$username;?>">more info</a>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
    </div>

    <?php include('templates/footer.php'); ?>
</html>