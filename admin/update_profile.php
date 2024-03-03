<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    
    $update_name = $conn->prepare("UPDATE `admins` SET name=? WHERE id =?");
    $update_name->execute([$name, $admin_id]);

    $empty_pass = '';
    $select_old_pass = $conn->prepare("SELECT password FROM `admins` WHERE id =?");
    $select_old_pass->execute([$admin_id]);
    $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['password'];
    $old_pass = $_POST['old_pass'];
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = $_POST['new_pass'];
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $confirm_pass = $_POST['confirm_pass'];
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if($old_pass == $empty_pass){
        $message[] = 'please enter old password';
    }elseif($old_pass != $prev_pass){
        $message[] = 'old password not matched!';
    }elseif($new_pass != $confirm_pass){
        $message[] = 'confirm password not matched';
    }else{
        if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `admins` SET password =? WHERE id=?");
            $update_pass->execute([$confirm_pass, $admin_id]);
            $message[] = 'password updated successfully!';
        }else{
            $message[] = 'please enter the new password!';
        }
    }

}


?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update-profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>


<?php include '../components/admin_header.php'; ?> 

<section class="form-container">
    <form action="" method="POST">
        <h3>update profile</h3>
        <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password'];?>">
        <input type="text" name="name" maxlength="20" value="<?= $fetch_profile['name'];?>" placeholder="enter your username" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
        <input type="password" name="old_pass" maxlength="20" placeholder="enter your old password" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
        <input type="password" name="new_pass" maxlength="20" placeholder="enter your new password" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
        <input type="password" name="confirm_pass" maxlength="20" placeholder="confirm your new password" class="box" oninput="this.value= this.value.replace(/\s/g, '')">
        <input type="submit" value ="update now" name="submit" class="btn">
    </form>
</section> 

<script src="../js/admin_script.js"></script>
</body>
</html>