<?php include('server.php') ?>
<?php include_once 'header.php'; ?>
<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="" action="login.php" method="post">
            <?php include('errors.php'); ?>
            <span id="reauth-email" class="reauth-email"></span>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o"></i></span>
                </div>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="El. pašto adresas" required autofocus>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i>
</span>
                </div>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Slaptažodis" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-success" type="submit" name="login_user">Prisijungti</button>
        </form>
    </div>
</div>
<?php include_once 'footer.php'; ?>
