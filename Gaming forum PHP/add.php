<?php

    include('config/db_connect.php');

    $title = $genre = $description = "";   //params inside of the form
    $errors = array('title' => '', 'genre' => '', 'description' => '');  // array with errors for each param

    if(isset($_GET['user'])) {   // geting the username of the user that is logged in
        $username = mysqli_real_escape_string($conn, $_GET['user']);  // setting the username

        $query = "SELECT * FROM user WHERE username = '$username'";  // returning actual user (for the id)
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id'];   // id that goes into new idea
        mysqli_free_result($result);
    }

    if(isset($_POST['submit'])) {  // if the add form is submited

        $query = "SELECT max(id) AS max FROM idea WHERE user=$user_id";  // returning the max id of an idea for that user so we know which one is the next
        $result = mysqli_query($conn, $query);
        $maxidarr = mysqli_fetch_all($result);
        $maxid = $maxidarr[0][0];
        mysqli_free_result($result);

        ### FORM VALIDATION ###
        // very similar validation to the one in register, login etc.

        if(empty($_POST['title'])) {
            $errors['title'] = "Title is required! <br/>";
        } else {
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $errors['title'] = 'Wrong input for the title!';
            } 
        }

        if(empty($_POST['genre'])) {
            $errors['genre'] = "Genre is required! <br/>";
        } else {
            $genre = $_POST['genre'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $genre)) {
                $errors['genre'] = 'Wrong input for the genre!';
            } 
        }

        if(empty($_POST['description'])) {
            $errors['description'] = "Description is required! <br/>";
        } else {
            $description = $_POST['description'];
        }

        ### END OF FORM VALIDATION ###

        ### INSERTING NEW IDEA ###

        if(!array_filter($errors)) {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $genre = mysqli_real_escape_string($conn, $_POST['genre']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
        
            $query = "INSERT INTO idea(id, user, title, genre, description) VALUES
                ($maxid+1, $user_id, '$title', '$genre', '$description')";

            // setting id to max + 1

            if(mysqli_query($conn, $query)) {
                mysqli_close($conn);
                header('Location: homepage.php?user='.$username);
            } else {
                echo 'Error: '.mysqli_error($conn);
            }
        }

        ### IDEA INSERTED ###
 
    }

?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add an idea</h4>
        <form class="white form" action="<?php echo $_SERVER['PHP_SELF']."?user=".$username ?>" method="POST">
            <label for="">Title of your idea:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>
            <label for="">Genre of the game:</label>
            <input type="text" name="genre" value="<?php echo htmlspecialchars($genre) ?>"
                onkeyup="showSuggestion(this.value)">
            <div class="red-text"><?php echo $errors['genre']; ?></div>
            <p>Suggested genres: <span id="output"></span></p>
            <label for="">Short description:</label>
            <textarea name="description" value="<?php echo htmlspecialchars($description) ?>" style="border:none;border-bottom:1px solid;"></textarea>
            <div class="red-text"><?php echo $errors['description']; ?></div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>

    <script>
        // AJAX for genre suggestion (same as one for countries)
        function showSuggestion(str) {
            if(str.length == 0) {
                document.getElementById("output").innerHTML = "";
            } else {
                // AJAX request
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
                        document.getElementById("output").innerHTML = this.responseText;
                    }
                }
                xmlhttp.open("GET", "suggestions/genresuggest.php?q="+str, true);
                xmlhttp.send();
            }
        }
    </script>
</html>