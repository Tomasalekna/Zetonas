<?php include_once 'header.php';
/* Error showing
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
*/
?>
<?php  if (isset($_SESSION['email'])) : ?>
    <?php include('server.php') ?>



<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card">Slaptažodžio keitimas</p>
        <form class="form-signin" action="changePassword.php" method="post">
            <?php include 'errors.php'; ?>
            <span id="reauth-email" class="reauth-email"></span>
            <input type="password" name="oldPassword" id="inputPassword" class="form-control" placeholder="Senas slaptažodis" required>
            <input type="password" name="newPassword_1" id="inputPassword" class="form-control" placeholder="Naujas slaptažodis" required>
            <input type="password" name="newPassword_2" id="inputPassword" class="form-control" placeholder="Pakartokite slaptažodį" required>
            <button class="btn btn-lg btn-primary btn-block btn-success" type="submit" name="changePassword">Pakeisti</button>
        </form>
    </div>
</div>

<?php endif; ?>
    <?php  if (empty($_SESSION['email']))
    {
        header("location: login.php");
    }
    ?>

    <?php include_once 'footer.php'; ?>