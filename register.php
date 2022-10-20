<?php include 'server.php'; ?>
<?php include_once 'header.php'; ?>


<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card">Paskyros sukūrimas</p>
        <form class="form-signin" action="register.php" method="post">
            <?php include 'errors.php'; ?>
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" name="email" value="<?php echo $email; ?>" id="inputEmail" class="form-control" placeholder="El. pašto adresas" required autofocus>
            <input type="password" name="password_1" id="inputPassword" class="form-control" placeholder="Slaptažodis" required>
            <input type="password" name="password_2" id="inputPassword" class="form-control" placeholder="Pakartokite slaptažodį" required>

            <button class="btn btn-lg btn-primary btn-block btn-success" type="submit" name="reg_user">Registruotis</button>
        </form><!-- /form -->
    </div><!-- /card-container -->
</div><!-- /container -->



<?php
include_once 'footer.php';
?>