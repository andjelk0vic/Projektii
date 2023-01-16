<?php
    
    include('components/db_config.php');

    if(isset($_GET['user'])) {
        $userID = mysqli_real_escape_string($conn, $_GET['user']);
    }

    $query = "SELECT * FROM salon WHERE user='$userID'"; 
    $result = mysqli_query($conn, $query);
    $salons = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

?>

<!DOCTYPE html>
<html>

    <?php include('components/header.php') ?>

    <div class="container">
        <h2 class="white-text center">Your Salon</h2>
        <?php include('components/salon_list.php') ?>
    </div>

    <?php include('components/footer.php') ?>

</html>