<?php
    
    include('config/db_connect.php');

    $username = $password = "";  //params inside of the form
    $errors = array('username' => '', 'password' => '');  // array with errors for each param

    if(isset($_POST['submit'])) {  // checking if form was submited

        ### FORM VALIDATION ###

        if(empty($_POST['username'])) {  // if we did not fill the username
            $errors['username'] = "Username is required! <br/>";  // ERR message
        } else {
            $username = $_POST['username'];  // putting what we typed in the variable $username so it will be shown even if the form is not valid

            $query = "SELECT * FROM user WHERE username = '$username'";   // sql query for getting the user with that username
            $result = mysqli_query($conn, $query);   // table with that user
            $users = mysqli_fetch_assoc($result);    // putting the table inside of associated array
            mysqli_free_result($result);             // freeing memory
            mysqli_close($conn);                     // closing connection
            
            if($users == null) {  // if there is not any user with that username
                $errors['username'] = "User with this username does not exists! <br/>";  // ERR message
            } elseif (empty($_POST['password'])) {  // if we did not fill the password
                $errors['password'] = "Password is required! <br/>"; // ERR message
            } else { 
                $password = $_POST['password'];  // putting what we typed in the variable $password so it will be shown even if the form is not valid

                if(strcmp($password, $users['password'])) {    // checking if the password match
                    $errors['password'] = "Wrong password! <br/>";  // ERR message
                } else {
                    session_start();    // starting the session for the user
                    $_SESSION['name'] = $_POST['username'];   
                    header('Location: homepage.php?user='.$_SESSION['name']);  // sending username
                }
            }
        }


    }

?>

<!-- HTML PAGE -->

<!DOCTYPE html>
<html lang="en">
    <!-- header for every page -->
    <?php include('templates/header_credentials.php'); ?>

    <!-- FORM -->
    <section class="container grey-text">
        <h4 class="center">Login</h4>
        <form class="white credentials" action="" method="POST">
            <label for="">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
            <div class="red-text"><?php echo $errors['username']; ?></div>

            <label for="">Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
            <div class="red-text"><?php echo $errors['password']; ?></div>

            <div class="center">
                <input type="submit" name="submit" value="LOGIN" class="btn brand z-depth-0 login">
            </div>
        </form>
    </section>

    <!-- footer for every page -->
    <?php include('templates/footer.php'); ?>

</html>