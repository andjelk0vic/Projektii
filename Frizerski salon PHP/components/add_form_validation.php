<?php

    if(empty($_POST['salonname'])) {
        $errors['salonname'] = 'Salon name is required!';
    } else {
        $salonname = $_POST['salonname'];
    }

    if(empty($_POST['address'])) {
        $errors['address'] = 'Address is required!';
    } else {
        $address= $_POST['address'];
    }
    


    if(empty($_POST['category'])) {
        $errors['category'] = 'Category is required!';
    } else {
        $category = $_POST['category'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $category)) {
            $errors['category'] = 'Wrong input for the category!'; 
            $category = '';
        }
    }


?>