<?php
    
    include('components/db_config.php');

    $name = $lastname = $email = $username = $password = $confirmpassword = $contact = "";

    $errors = ['name' => '', 'lastname' => '', 'username' => '', 'email' => '',
        'password' => '', 'confirmpassword' => '', 'contact' => ''];

    if(isset($_POST['registration'])) {  

        if(empty($_POST['name'])) {  
            $errors['name'] = 'Name is required!';  
        } else {
            $name = $_POST['name']; 
            if(!preg_match('/^[a-zA-Z\s]+$/', $name)) { 
                $errors['name'] = 'Wrong input for the name!'; 
                $name = '';
            }
        }

        if(empty($_POST['lastname'])) {
            $errors['lastname'] = 'Lastname is required!';
        } else {
            $lastname = $_POST['lastname'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $lastname)) {
                $errors['lastname'] = 'Wrong input for the lastname!'; 
                $lastname = '';
            }
        }

        if(empty($_POST['email'])) { 
            $errors['email'] = "Email address is required!";
        } else {
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // php validacija email adrese
                $errors['email'] = 'Invalid email address!'; 
                $email = '';
            }
        }

        if(empty($_POST['username'])) {
            $errors['username'] = 'Username is required!';
        } else {
            $username = $_POST['username'];

            // provera da li već postoji korisničko ime koje je uneto
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
            $usersWithSameUsername = mysqli_fetch_assoc($result);
            mysqli_free_result($result);

            if($usersWithSameUsername != null) {  // ako niz nije prazan - imamo korisnike sa tim username
                $errors['username'] = "User with this username already exists!";
            }
        }

        if(empty($_POST['contact'])) {
            $errors['contact'] = 'Contact number is required!';
        } else {
            $contact = $_POST['contact'];
            if(!preg_match('/^[0-9]{10}$/', $contact)) {  // provera da li je contact sačinjen samo od brojeva kojih ima tačno 10
                $errors['contact'] = 'Wrong input for the contact number!'; 
                $contact = '';
            }
        }

        if(empty($_POST['password'])) {
            $errors['password'] = "Password is required!";
        } else {
            $password = $_POST['password']; 
            if(strlen($password) < 8) {   // provera da li je password kraći od 8 znakova
                $errors['password'] = "Password must be at least 8 characters long!";
            }
        }

        if(empty($_POST['confirmpassword'])) {
            $errors['confirmpassword'] = "Password confirmation is required!";
        } else {
            $confirmpassword = $_POST['confirmpassword']; 
            if($confirmpassword != $password) {   // provera da li se šifre slažu
                $errors['confirmpassword'] = "Passwords do not match!";
                $confirmpassword = $password = "";
                $password = "";
            }
        }

        if(!array_filter($errors)) {  // ako niz grešaka ima samo false vrednosti tj. prazne stringove
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // upit za unos novog korisnika u bazu
            $query = "INSERT INTO user(name, lastname, email, contact, username, password) 
                    VALUES ('$name', '$lastname', '$email', '$contact', '$username', '$password')";

            if(mysqli_query($conn, $query)) {
                header('Location: login.php'); // prebacivanje korisnika na stranicu login ako je forma odgovarajuće popunjena
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
        <h4 class="center white-text">Create account to promote your salon</h4>
        
        <form class="white credentials form" action="" method="POST">
            <label for="name">First name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
            <div class="red-text"><?php echo $errors['name']; ?></div>       

            <label for="lastname">Last name:</label>
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname) ?>">
            <div class="red-text"><?php echo $errors['lastname']; ?></div>       

            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
            <div class="red-text"><?php echo $errors['username']; ?></div>       

            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>       

            <label for="contact">Contact number:</label>
            <input type="text" name="contact" value="<?php echo htmlspecialchars($contact) ?>">
            <div class="red-text"><?php echo $errors['contact']; ?></div>       

            <label for="password">Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
            <div class="red-text"><?php echo $errors['password']; ?></div>       

            <label for="confirmpassword">Confirm password:</label>
            <input type="password" name="confirmpassword" value="<?php echo htmlspecialchars($confirmpassword) ?>">
            <div class="red-text"><?php echo $errors['confirmpassword']; ?></div>       
            
            <div class="center">
                <input type="submit" name="registration" value="Create account" class="btn brand z-depth-0>
            </div>
        </form>
    </section>

    <?php include('components/footer.php') ?>

</html>


