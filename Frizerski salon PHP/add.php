<?php

    include('components/db_config.php');

    if(isset($_GET['user'])) {
        $userID = mysqli_real_escape_string($conn, $_GET['user']);
    }

    $salonname = $address = $category = "";
    $errors = ['salonname' => '', 'address' => '', 'category' => ''];

    if(isset($_POST['insert'])) {

        include('components/add_update_form_validation.php'); 

        if(!array_filter($errors)) {
            $title = $_POST['salonname'];
            $author = $_POST['address'];
            $category = $_POST['category'];

            $query = "INSERT INTO salon(user, salonname, address, category) 
                    VALUES ('$userID', '$salonname', '$address', '$category')";

            if(mysqli_query($conn, $query)) {
                header('Location: index.php?user='.$userID);
            } else {
                echo 'Error: '.mysqli_error($conn);
            }
        }


    }
    
?>

<!DOCTYPE html>
<html>

    <?php include('components/header.php') ?>

    <section class="container grey-text">
        <h4 class="center white-text">Add salon</h4>
        
        <!-- FORM -->
        <form class="white form" action="" method="POST">
        
        <!-- unos forme bez submit dugmeta -->
            <?php include('components/add_update_form.php') ?>
            
            <div class="center">
                <input type="submit" name="insert" value="Add salon" 
                    class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('components/footer.php') ?>

</html>