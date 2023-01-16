<?php
    
    include('components/db_config.php');

    $query = "SELECT * FROM salon";   
    $result = mysqli_query($conn, $query);  
    $salons = mysqli_fetch_all($result, MYSQLI_ASSOC);   
    mysqli_free_result($result);  

?>

<!DOCTYPE html>
<html>

    <?php include('components/header.php') ?> 

        <div class="container">
            <?php include('components/salon_list.php') ?>
        </div>

    <?php include('components/footer.php') ?>

</html>
