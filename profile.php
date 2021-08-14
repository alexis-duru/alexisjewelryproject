<?php $page = 'Profile'; ?>
<?php require 'inc/header.php'?>

<?php

if (!empty($_SESSION)) {

    $user_id = $_SESSION['id'];
    $sqlUser = "SELECT * FROM user WHERE id = '{$user_id}'";
    $resultUser = $connect->query($sqlUser);
    if ($user = $resultUser->fetch(PDO::FETCH_ASSOC)) {
?>

<section>
        <div class="window">
            <div class="window-in">
                <h2>WELCOME <?php echo $user['username']; ?></h2>
                <div class="photoprofil">
                <?php if (is_null($user['photo']) || empty($user['photo'])) {
                            echo "<img src='./public/uploads/default.jpg' width=200/> ";
                        } else {
                        ?>
                            <img src="./public/uploads/<?php echo $rental['image']; ?>" alt='<?php echo $rental['rental_name']; ?>' width='200' />
                        <?php
                        }
                        ?>
                </div>
                <?php
                if ($user['role'] === 'ROLE_ADMIN') {
                    echo '<a class="middle-btn" href="dashboard.php">ADMINISTRATOR</a>';?>
                <?php
                }
                ?>
            </div>
        </div>
</section>
    <?php
    } else {
        echo " Erreur de connexion, veuillez vous reconnecter";
        session_destroy();
    }
} else {
    ?>
    <div>
        <p>You cannot access your profile without logging in</p>
        <p>
            <a href="login.php">SIGN-IN</a>
        </p>
    </div>

<?php
}
?>

<?php require 'inc/footer.php' ?>
