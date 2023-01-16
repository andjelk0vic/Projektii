<?php

    include('config/db_connect.php');

    // Getting user from the database so we can show his information
    if(isset($_GET['user'])) {
        $current_user = mysqli_real_escape_string($conn, $_GET['user']);

        $query = "SELECT * FROM user WHERE username = '$current_user'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];
        mysqli_free_result($result);
        $query = "SELECT * FROM idea WHERE user = $user_id";
        $result = mysqli_query($conn, $query);
        $ideas = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        $noOfIdeas = count($ideas);
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>

    <div class="container center">
        <h3 class="center">Info</h3>
        <p>Name: <?php echo $user['name']." ".$user['lastname']; ?></p>
        <p>Username: <?php echo $user['username']; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>From: <?php echo $user['country']; ?></p>
        <p>Number of ideas: <?php echo $noOfIdeas; ?></p>
        <div class="">
            <a class="btn brand z-depth-0 dets" href="passchange.php?user=<?php echo $current_user; ?>">Change password</a>
        </div>
    </div>

    <?php if($noOfIdeas != 0): ?>
        <div class="container">
            <h4 class="center">Your ideas</h4>
            <div class="row">
                <?php foreach($ideas as $idea): ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <img src="img/logo.webp" class="logo">
                        <div class="card-content center">
                            <h6> <?php echo htmlspecialchars($idea['title']); ?> </h6>
                            <p> <?php echo htmlspecialchars($idea['description']); ?></p>
                        </div>
                        <div class="card-action right-align">
                            <a class="brand-text" href="details.php?id=<?php echo $idea['user'].",".$idea['id'].",".$current_user;?>">more info</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php include('templates/footer.php'); ?>
</html>