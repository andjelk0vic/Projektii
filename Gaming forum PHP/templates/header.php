<?php

    include('config/db_connect.php');

    if(isset($_GET['user'])) {   // getting the user that is logged in
        $current_user = mysqli_real_escape_string($conn, $_GET['user']);   // setting the user
    }

?>

<!-- HTML HEADER -->
<head>
    <title>Ubisoft Forum</title>
    <link rel="icon" href="img/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        /* CSS */
        .header {
            background-color: #4797ca;
        }
        .brand {
            background: #4797ca !important;
        }
        .brand-text {
            color: #4797ca !important;
        }
        .form {
            padding: 10px;
            margin-left: 25%;
            width: 50%;
            text-align: center;
        }
        .navul {
            margin-right: 100px;
        }
        .logo {
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;
        }
        .dets {
            padding-bottom: 20px;
        }
    </style>
</head>
<body class="grey lighten-4">

    <!-- navigation menu -->
    <nav class="white header z-depth-0">
        <div class="container">
            
            <a href="homepage.php?user=<?php echo $current_user; ?>" class="brand-logo brand-text">Ubisoft Gaming Forum</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down navul">
                <li><a href="add.php?user=<?php echo $current_user;?>" class="btn brand z-depth-0">Add Idea</a></li>
                <li><a href="profile.php?user=<?php echo $current_user;?>" class="btn brand z-depth-0">Your Profile</a></li>
                <li><a href="login.php" class="btn brand z-depth-0">Logout</a></li>
            </ul>
        </div>
    </nav>
