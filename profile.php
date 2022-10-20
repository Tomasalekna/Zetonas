<?php include_once 'header.php'; ?>
<?php  if (isset($_SESSION['email'])) : ?>
    <?php
    if(empty($_SESSION['coinshad'])){$coinshad = 0;} else {$coinshad = $_SESSION['coinshad'];};
    if(empty($_SESSION['coinsleft'])){$coinsleft = 0;} else {$coinsleft = $_SESSION['coinsleft'];};
    ?>
    <div class="container">
        <div class="card card-container ">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"><?php echo $_SESSION['email']; ?></p>
              <div class="card-body">
                <h4 class="card-title">Sveiki sugrįžę!</h4>
                  <ul class="list-group list-group-flush">
                      <p class="list-group-item">Žetonų likutis: <?php echo $coinsleft; ?></p>
                      <p class="list-group-item"><a href="addCoins.php" class="card-link">Papildyk žetonus</a></p>
                      <p class="list-group-item"><a href="changePassword.php" class="card-link">Keisti slaptažodį</a></p>
                      <p class="list-group-item"><a href="history.php" class="card-link">Istorija</a></p>
                      <a href="wash.php" class="btn btn-primary">Plauti</a>
                  </ul>
              </div>
        </div>
    </div>
<?php endif; ?>

<?php  if (empty($_SESSION['email'])) {
    header("location: login.php");
    }
    ?>
<?php include_once 'footer.php'; ?>