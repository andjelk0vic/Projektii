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
        .credentials {
            padding: 10px;
            margin-left: 25%;
            width: 50%;
            text-align: center;
        }
        .navul {
            margin-right: 100px;
        }
        .login {
            margin-top: 30px;
        }
        .logo {
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;
        }
    </style>
</head>

<!-- HTML HEADER -->

<body class="grey lighten-4">
    <!-- navigation menu -->
    <nav class="white header z-depth-0">
        <div class="container">
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>" class="brand-logo brand-text">Ubisoft Gaming Forum</a>
        </div>
        <ul id="nav-mobile" class="right hide-on-small-and-down navul">
            <li><a href="index.php" class="btn brand z-depth-0">Register</a></li>
            <li><a href="login.php" class="btn brand z-depth-0">Login</a></li>
        </ul>
    </nav>