<?php

    include('config/db_connect.php');

    if(isset($_GET['id'])) {  // geting the id the user and the username
        $id = mysqli_real_escape_string($conn, $_GET['id']); // setting
        $ids = explode(",", $id);  // since its in a string (id,user,username) we're splitting it
        $current_user = $ids[2];   // setting current username
   
        $query = "SELECT * FROM idea WHERE user = $ids[0] AND id = $ids[1]";   // sql query for returning the idea that we wanted to see
        $result = mysqli_query($conn, $query);
        $idea = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        $query = "SELECT * FROM user WHERE id = $ids[0]";   // returning user that posted the idea
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    }

    if(isset($_POST['delete'])) {   // if the delete form is submited
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);  // getting id of an idea that we want to delete
        $ids_to_delete = explode(",", $id_to_delete);  // splitting the ids 
        $query = "DELETE FROM idea WHERE user = '$ids_to_delete[0]' AND id = '$ids_to_delete[1]'";  // sql query for deleting idea
        if(mysqli_query($conn, $query)) {
            header('Location: homepage.php?user='.$current_user);  // redirecting to homepage
        } else {
            echo 'Error: '.mysqli_error($conn);   // ERR message
        }
    }
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>

    <div class="container center grey-text">
        <!-- checking if the idea exist -->
        <?php if($idea): ?>
        <div class="card z-depth-0">
            <!-- idea info -->
            <img src="img/logo.webp" class="logo">
            <h3><?php echo htmlspecialchars($idea['title']); ?></h3>
            <h4>Posted by: <?php echo htmlspecialchars($user['username']); ?></h4>
            <p><?php echo htmlspecialchars($idea['description']); ?></p>
            <p>Genre: <?php echo htmlspecialchars($idea['genre']); ?></p>
            <p class="dets"> <?php echo date($idea['created_at']); ?></p>
            <!-- delete form -->
            <?php if($current_user == $user['username']): ?>
                <form action="" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo $idea['user'].",".$idea['id']; ?>">
                    <input type="submit" name="delete" value="delete" class="btn brand z-depth-0 dets">
                </form> 
            <?php endif; ?>
        </div>

        <!-- if idea does not exist anymore -->
        <?php else: ?>
            <h5>This post is deleted or it was never here!</h5>
        <?php endif; ?>
    </div>

    <?php include('templates/footer.php'); ?>
</html>