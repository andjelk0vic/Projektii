<?php
    
    include('components/db_config.php');

    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $id_array = explode(",", $id);
        $salon_user = $id_array[0]; 
        $salon_id = $id_array[1]; 
        $current_user_id = $id_array[2];

        // uzimamo salon iz baze
        $query = "SELECT * FROM salon WHERE user = $salon_user AND id = $salon_id";
        $result = mysqli_query($conn, $query);
        $salon = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        // uzimamo korisnika koji je kreirao salon iz baze da bismo znali da li prikazujemo dugmiće za izmenu i brisanje
        $query = "SELECT * FROM user WHERE id = $salon_user";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    }

?>

<!DOCTYPE html>
<html>

    <?php include('components/header.php') ?>

    <?php if($salon == null): ?>

        <h1 class="center white-text">There is not such salon!</h1>
        <div class="center">
        <a class="btn white center teal-text" 
            href="index.php?user=<?php echo $current_user_id; ?>">Return</a>
        </div>

    <?php else: ?>

        <div class="container center">
            <div class="card z-depth-0 radius-card">
                <img class="logo-card" src="img/card.webp">
                <h2> <?php echo $salon['salonname']; ?></h2>
                <h4>Address: <?php echo $salon['address']; ?> </h4>
                <p style="padding-bottom: 10px;">
                <h5>Category: <?php echo $salon['category']; ?>  </h5>
                <p style="padding-bottom: 10px;">
            
            </div>
        </div>

    <?php endif; ?>

    <?php include('components/footer.php') ?>

</html>
