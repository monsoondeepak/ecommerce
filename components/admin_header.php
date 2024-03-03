<?php
include '../components/connect.php';
if(isset($message)){
    foreach($message as $message){
        echo '<div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove()";></i>
    </div>';
    }
}

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:../admin/admin_login.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <header class="header">

        <section class="flex">
            <a href="dashboard.php" class="logo">Admin <span>Panel</span></a>
            <nav class="navbar">
                <a href="dashboard.php">home</a>
                <a href="products.php">products</a>
                <a href="placed_orders.php">orders</a>
                <a href="admin_accounts.php">admins</a>
                <a href="users_accounts.php">users</a>
                <a href="messages.php">messages</a>
            </nav>
            
            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="user-btn" class="fas fa-user"></div>
            </div>
            
            <div class="profile">
                <?php
                $admin_id = $_SESSION['admin_id'];
                $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id=?");
                $select_profile->execute([$admin_id]);
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
            <p><?= $fetch_profile['name']; ?></p>
            <a href="update_profile.php" class="btn">update profile</a>
            <div class="flex-btn">
                <a href="../admin/admin_login.php" class="option-btn">login</a>
                <a href="../admin/register_admin.php" class="option-btn">register</a>
            </div>
            <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('logout from this website?');">logout</a>
        </div>
        
    </section>
</header>
   


<script src="../js/admin_script.js"></script>
</body>
</html>

