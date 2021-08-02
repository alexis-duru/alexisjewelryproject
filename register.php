<?php $page = 'Register'; ?>
<?php require 'inc/header.php' ?>
<?php
    if (!empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['password2_signup']) && !empty($_POST['username_signup']) &&  isset($_POST['submit_signup'])) {
        $email = htmlspecialchars($_POST['email_signup']);
        $password1 = htmlspecialchars($_POST['password1_signup']);
        $password2 = htmlspecialchars($_POST['password2_signup']);
        $username = htmlspecialchars($_POST['username_signup']);

        try {
           if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $sqlMail = "SELECT * FROM user WHERE email = '{$email}'";
               $resultMail = $connect->query($sqlMail);
               $countMail = $resultMail->fetchColumn();
               if (!$countMail) {
                   //? Etape 3 : Vérification de la disponibilité de l'username dans la BDD
                   $sqlUsername = "SELECT * FROM user WHERE username = '{$username}'";
                   $resultUsername = $connect->query($sqlUsername);
                   $countUsername = $resultUsername->fetchColumn();
                   if (!$countUsername) {
                       if ($password1 === $password2) {
                           $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                           $sth = $connect->prepare("INSERT INTO user (email,username,password) VALUES (:email,:username,:password)");
                           $sth->bindValue(':email', $email);
                           $sth->bindValue(':username', $username);
                           $sth->bindValue(':password', $hashedPassword);
                           $sth->execute();
                           echo "L'utilisateur a bien été enregistré !";
                       } else {
                           echo "Les mots de passe ne sont pas concordants.";
                           unset($_POST);
                       }
                   } else {
                       echo " Ce nom d'utilisateur existe déja";
                       unset($_POST);
                   }
               } else {
                   echo "Un compte existe déja pour cette adresse mail";
                   unset($_POST);
               }
           } else {
               echo "L'adresse email saisie n'est pas valide";
               unset($_POST);
           }
       } catch (PDOException $error) {
           echo 'Error: ' . $error->getMessage();
       }
   }
?>

<section>
        <div class="window">
            <div class="window-in" >
                <h2>REGISTER</h2>
                <form action="#" method="POST" class="register-form">
                    <div class="register-box-formulaire">
                        <label>EMAIL</label>
                        <input class="register-input-form" type="email" placeholder="exemple@mail.com" name="email_signup" required>
                    </div>

                    <div class="register-box-formulaire">
                        <label>USERNAME</label>
                        <input class="register-input-form" type="text" placeholder="choose a username" name="username_signup" required>
                    </div>

                    <div class="register-box-formulaire">
                        <label>CHOOSE A PASSWORD</label>
                        <input class="register-input-form" type="password" placeholder="choose a password"
                        name="password1_signup" required>
                    </div>

                    <div class="register-box-formulaire">
                        <label>ENTER YOUR PASSWORD AGAIN</label>
                        <input class="register-input-form" type="password" placeholder="enter your password again" name="password2_signup" required>
                    </div>

                    <!-- <div class="register-box-formulaire">
                        <div>
                            <input class="register-input-form" id="cgu-check" type="checkbox" placeholder="" required>
                            <label><p>Accept the terms and conditions</p></label>
                        </div>
                    </div> -->
                    <div class="register-box-formulaire">
                        <button class="register-input-form" type="submit" name="submit_signup" value="inscription">REGISTER NOW</button>
                    </div>
                </form>
            </div>
        </div>
</section>
<?php require 'inc/footer.php' ?>