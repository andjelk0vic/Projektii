<div class="row">
    <?php foreach($salons as $salon): ?>
    	<div class="col s6 md3">
            <div class="card z-depth-0 radius-card">
                <img src="img/card.webp" class="logo-card">
                <div class="card-content center">
                    <h6> <?php echo htmlspecialchars($salon['salonname']); ?> </h6>
                    <p> <?php echo htmlspecialchars($salon['address']); ?></p>
                </div>
                <div class="card-action right-align radius-card">
                    <a class="pink-text text-darken" href="salon.php?id=<?php echo $salon['user']
                        .','.$salon['id'].','.$userID?>">more info</a>
                </div>
            </div>
        </div>
     <?php endforeach; ?>
</div>