<?php

    include('db_config.php'); 

    $flag = 0;
    $userID=0; 

    if(isset($_GET['user'])) {   // u url trazimo user= ____
        $userID = mysqli_real_escape_string($conn, $_GET['user']);
        $flag = 1;  // signaliziramo da je korisnik ulogovan
    }

    // sa stranice More Info
    if(isset($_GET['id'])) {   // u url trazimo id= ____
        $id = mysqli_real_escape_string($conn, $_GET['id']);   
        $id_array = explode(",", $id);   // split funckija za string 
        $flag = 1;  // signaliziramo da je korisnik ulogovan
        $userID = $id_array[2];
    }

    if(isset($_GET['updateid'])) {   // u url trazimo updateid= ____
        $id = mysqli_real_escape_string($conn, $_GET['updateid']);  
        $id_array = explode(",", $id); 
        $flag = 1;  // signaliziramo da je korisnik ulogovan
        $userID = $id_array[0];
    }

?>

<head>
    <title>HairdresserSalons</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <style type="text/css">
        /* CSS */
        .hairdressersalon-text {
            font-size: xx-large;
            font-family: fantasy;
        }
        .brand {
            background: #4797ca !important;
        }
        .logo {
            max-width: 55px;
            height: auto;
        }

        .form {
            padding: 10px;
            margin-left: 25%;
            width: 50%;
            text-align: center;
            border-radius: 25px;
        }
        .logo-card {
            width: 110px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            padding: 20px;
        }
        .radius-card {
            border-radius: 0px;

        }
    </style>
</head>
<body class="light-blue lighten-3">
    <nav class="white header z-depth-01">
        <div class="container">

            <?php if($flag == 0): ?>    
                <!-- ako korisnik nije ulogovan -->

                <a href="index.php" class="light-blue-text text-darken-1 hairdressersalon-text">
                    <img class="logo" src="img/logo.png">Hairdresser</a>
                <a href="index.php" class="pink-text text-accent-4 hairdressersalon-text">Salons</a>

                <ul id="nav-mobile" class="right hide-on-small-and-down navul">
                    <li><a href="registration.php" class="btn brand z-depth-0">Registration</a></li>
                    <li><a href="login.php" class="btn brand z-depth-0">Login</a></li>
                </ul>

            <?php elseif($flag == 1): ?>
                <!-- ako je korisnik ulogovan -->
            
                <a href="index.php?user=<?php echo $userID; ?>" class="light-blue-text text-darken-1 hairdressersalon-text">
                    <img class="logo" src="img/logo.png">Hairdresser</a>
                <a href="index.php?user=<?php echo $userID; ?>" class="pink-text text-accent-4 hairdressersalon-text">Salon</a>
                
                <ul id="nav-mobile" class="right hide-on-small-and-down navul">
                    <li><a href="add.php?user=<?php echo $userID ?>" class="btn brand z-depth-0">Add Salon</a></li>
                    <li><a href="profile.php?user=<?php echo $userID ?>" class="btn brand z-depth-0">Your Salon</a></li>
                    <li><a href="login.php" class="btn brand z-depth-0">Logout</a></li>
                </ul>

            <?php endif; ?>
        </div>
    </nav>