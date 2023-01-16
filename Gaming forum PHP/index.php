<!--  REGISTRATION PAGE -->

<?php
    include('config/db_connect.php');   //connection

    $name = $lastname = $email = $username = $password = $confirmpass = $country = "";    //params inside of the form
    $errors = array('name' => '', 'lastname' => '', 'email' => '',     
        'username' => '', 'password' => '' , 'confirmpass' => '', 'country' => '');   // array with errors for each param

    if(isset($_POST['submit'])) {     // checking if form was submited

        ### FORM VALIDATION ###

        if(empty($_POST['name'])) {     // if we did not fill the name
            $errors['name'] = "Name is required! <br/>";   // ERR message
        } else {
            $name = $_POST['name'];     // putting what we typed in the variable $name so it will be shown even if the form is not valid
            if(!preg_match('/^[a-zA-Z\s]+$/', $name)) {    // checking if its only letters and spaces with REGEX
                $errors['name'] = 'Wrong input for the name!';  // ERR message
            } 
        }

        if(empty($_POST['lastname'])) {   // if we did not fill the lastname
            $errors['lastname'] = "Lastname is required! <br/>";   // ERR message
        } else {
            $lastname = $_POST['lastname'];   // putting what we typed in the variable $lastname so it will be shown even if the form is not valid
            if(!preg_match('/^[a-zA-Z\s]+$/', $lastname)) {   // checking if its only letters and spaces with REGEX
                $errors['lastname'] = 'Wrong input for the lastname!';   // ERR message
            } 
        }

        if(empty($_POST['email'])) {  // if we did not fill the email
            $errors['email'] = "Email address is required! <br/>";   // ERR message
        } else {
            $email = $_POST['email'];   // putting what we typed in the variable $email so it will be shown even if the form is not valid
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {    // PHP email validation
                $errors['email'] = 'Invalid email address!';   // ERR message
            }
        }

        if(empty($_POST['username'])) {  // if we did not fill the username
            $errors['username'] = "Username is required! <br/>";   // ERR message
        } else {
            $username = $_POST['username'];   // putting what we typed in the variable $username so it will be shown even if the form is not valid

            $query = "SELECT * FROM user WHERE username = '$username'";    // sql query for returnig all users that have the same username as the one we inserted
            $result = mysqli_query($conn, $query);     // returning the table with the sql query
            $users = mysqli_fetch_assoc($result);      // making associative array from the table (result)
            mysqli_free_result($result);               // deleting result from memory
            
            if($users != null) {    // if the list is not empty
                $errors['username'] = "User with this username already exists! <br/>";   // ERR message
            } 
        }

        if(empty($_POST['password'])) {   // if we did not fill the password
            $errors['password'] = "Password is required! <br/>";   // ERR message
        } else {
            $password = $_POST['password'];   // putting what we typed in the variable $password so it will be shown even if the form is not valid
            if(strlen($password) < 8) {     // if the password length is less than 8
                $errors['password'] = "Password must be at least 8 characters long! <br/>";   // ERR message
            }
        }

        if(empty($_POST['confirmpass'])) {  // if we did not fill the password confirmation
            $errors['confirmpass'] = "Confirm your password!<br/>";   // ERR message
        } else {
            $confirmpass = $_POST['confirmpass'];   // putting what we typed in the variable $confirmpass so it will be shown even if the form is not valid
            if($confirmpass != $password) {      // if the pass and confirm pass are different
                $errors['password'] = "Passwords do not match! <br/>";   // ERR message
                $errors['confirmpass'] = "Passwords do not match! <br/>";   // ERR message
            }
        }

        include('suggestions/countries.php');

        if(empty($_POST['country'])) {   // if we did not fill the country
            $errors['country'] = "Country is required!<br/>";   // ERR message
        } else {
            $country = $_POST['country'];   // putting what we typed in the variable $country so it will be shown even if the form is not valid
            if(strtolower($country) == "kosovo") {   // :)
                $errors['country'] = "bms";   // ERR message
            } elseif(!in_array($country, $country_list)) {    // if there is country that we typed inside of the country list
                $errors['country'] = "No such country exist!";  // ERR message
            }
        }

        ### END OF FORM VALIDATION ###


        ### CREATING THE USER ###

        if(!array_filter($errors)) {      // if there are no errors 
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $country = mysqli_real_escape_string($conn, $_POST['country']);
            // putting what we typed inside of the variables with precausion (real escape string)

            $query = "INSERT INTO user(name, lastname, email, username, password, country)   
                VALUES ('$name', '$lastname', '$email', '$username', '$password', '$country')";    // sql query for inserting user in the database

            if(mysqli_query($conn, $query)) {     // if everything is ok (if user was inserted)
                header('Location: login.php');    // redirecting to login page
            } else {
                echo 'query error: '.mysqli_error($conn);    // ERR message
            }
        }

        ### END OF CREATING AND INSERTING THE USER ###
    

    }
?>

<!DOCTYPE html>

    <script>
        // AJAX suggestions for country 
        function showSuggestion(str="") {   
            if(str.length == 0) {  
                document.getElementById("outputCountry").innerHTML = ""; // if we did not type anything nothing will be shown inside of span
            } else {  
                // AJAX request
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {    // when the request is ready
                    if(this.readyState == 4 && this.status == 200) {   // checking params for request readiness
                        document.getElementById("outputCountry").innerHTML = this.responseText;   // writing suggestions inside of a span
                    }
                }
                xmlhttp.open("GET", "suggestions/countries.php?qc="+str, true);     // making request for what we typed in to a file that finds the suggestions
                xmlhttp.send();  // sending request
            }
        }
    </script>


<!-- HTML PAGE -->

<html lang="en">
    <!-- header for every page -->
    <?php include('templates/header_credentials.php'); ?>   

    <!-- section for the form -->
    <section class="container grey-text">
        <h4 class="center">Register</h4>
        
        <!-- FORM -->
        <form class="white credentials" action="" method="POST">
            <label for="">First name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
            <div class="red-text"><?php echo $errors['name']; ?></div>       

            <label for="">Last name:</label>
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname) ?>">
            <div class="red-text"><?php echo $errors['lastname']; ?></div>

            <label for="">Email Address:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>

            <label for="">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
            <div class="red-text"><?php echo $errors['username']; ?></div>

            <label for="">Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password) ?>">
            <div class="red-text"><?php echo $errors['password']; ?></div>

            <label for="">Confirm password:</label>
            <input type="password" name="confirmpass" value="<?php echo htmlspecialchars($confirmpass) ?>">
            <div class="red-text"><?php echo $errors['confirmpass']; ?></div>

            <label for="">Country:</label>
            <input type="text" name="country" value="<?php echo htmlspecialchars($country) ?>" onkeyup="showSuggestion(this.value)">
            <div class="red-text"><?php echo $errors['country']; ?></div>
            <p><span id="outputCountry"></span></p>
            
            <div class="center">
                <input type="submit" name="submit" value="Register" class="btn brand z-depth-0 login">
            </div>
        </form>
    </section>

    <!-- footer for every page -->
    <?php include('templates/footer.php'); ?>
</html>