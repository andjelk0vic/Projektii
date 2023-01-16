<?php

    include('config/db_connect.php');

    if(isset($_GET['user'])) {
        $current_user = mysqli_real_escape_string($conn, $_GET['user']);

        $query = "SELECT * FROM user WHERE username = '$current_user'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    }

    $curpassword = $newpassword = "";
    $errors = ['curpassword' => '', 'newpassword' => ''];

    if(isset($_POST['changepass'])) {

        if(empty($_POST['curpassword'])) {
            $errors['curpassword'] = "Current password is required! <br/>";
        } else {
            $curpassword = $_POST['curpassword'];
            if(strcmp($curpassword, $user['password'])) {
                $errors['curpassword'] = "Wrong current password! <br/>";
            }
        }

        if(empty($_POST['newpassword'])) {
            $errors['newpassword'] = "New password is required! <br/>";
        } else {
            $newpassword = $_POST['newpassword'];
            if(strlen($newpassword) < 8) {
                $errors['newpassword'] = "Password must be at least 8 characters long! <br/>";
            }
            if(!strcmp($curpassword, $newpassword)) {
                $errors['newpassword'] = "New password can not be your old password! <br/>";
            }
        }

        if(!array_filter($errors)) {
            $newpassword = $_POST['newpassword'];
            $id = $user['id'];
            $query2 = "UPDATE user SET password = '$newpassword' WHERE id = '$id'";
            if(mysqli_query($conn, $query2)) {
                header('Location: profile.php'."?user=".$current_user);
            } else {
                echo 'query error: '.mysqli_error($conn);
            }
        }
    }

?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
        <h5 class="center">Change password: </h5>
        <form class="white form" action="" method="POST">
            <label for="">Current password:</label>
            <input type="password" name="curpassword" value="<?php echo htmlspecialchars($curpassword) ?>">
            <div class="red-text"><?php echo $errors['curpassword']; ?></div>
        
            <label for="">New password:</label>
            <input type="password" name="newpassword" value="<?php echo htmlspecialchars($newpassword) ?>">
            <div class="red-text"><?php echo $errors['newpassword']; ?></div>

            <div class="center">
                <input type="submit" name="changepass" value="Change Password" class="btn brand z-depth-0 login">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>
</html>