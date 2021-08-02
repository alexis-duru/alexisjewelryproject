<?php $page = 'Login'; ?>
<?php require 'inc/header.php' ?>
<?php
$alert = false;

if (isset($_GET['r'])) {
    $alert = true;
    $type = 'warning';
    $message = "Vous devez vous connecter pour réaliser cette opération";
}

if (!empty($_POST['email_login']) && !empty($_POST['password_login']) && isset($_POST['submit_login'])) {
    $email = htmlspecialchars($_POST['email_login']);
    $password = htmlspecialchars($_POST['password_login']);
    try {
        $sqlMail = "SELECT * FROM user WHERE email = '{$email}'";
        $resultMail = $connect->query($sqlMail);
        $user = $resultMail->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $dbpassword = $user['password'];
            if (password_verify($password, $dbpassword)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];

                $alert = true;
                $type = 'success';
                $message = "Vous êtes désormais connectés";
                unset($_POST);
                header('Location: index.php');
            } else {
                $alert = true;
                $type = 'danger';
                $message = "Le mot de passe est erroné";
                unset($_POST);
            }
        } else {
            $alert = true;
            $type = 'warning';
            $message = "Ce compte n'existe pas";
            unset($_POST);
        }
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>

<section>
        <div class="window">
            <div class="window-in">
                <h2>LOGIN</h2>
                <?php echo $alert ? "<div class='alert alert-{$type} mt-2'>{$message}</div>" : ''; ?>
                    <form action="#" method="POST" class="register-form">
                        <div class="register-box-formulaire">
                            <p>EMAIL</p>
                            <input class="login-input-form" type="email" placeholder="" name="email_login" required>
                        </div>
                        <div class="register-box-formulaire">
                            <p>PASSWORD</p>
                            <input class="login-input-form" type="password" placeholder="" name="password_login" required>
                        </div>
                        <div class="register-box-formulaire">
                            <button class="submit-btn" type='submit' href="" name="submit_login" value="connexion">LOGIN</button>
                        </div>
                    </form>
                    <p>If you do not yet have an account, you may : <a href='signin.php'>register here</a></p>
                </div>
            </div>
        </div>
</section>
<?php require 'inc/footer.php' ?>