<?php include_once 'header.php'; ?>
<?php  if (isset($_SESSION['email'])) : ?>
<?php include('server.php') ?>
<?php
    if(empty($_SESSION['coinshad'])){$coinshad = 0;} else {$coinshad = $_SESSION['coinshad'];};
    if(empty($_SESSION['coinsleft'])){$coinsleft = 0;} else {$coinsleft = $_SESSION['coinsleft'];};
    if(empty($_SESSION['userid'])){$userid = 0;} else {$userid = $_SESSION['userid'];};
?>
    <div class="container">
        <div class="card card-container">
            <div class="text-center">
                <form action="addCoins.php" method="post" id="carwash">
                    <h4>Sąskaitos papildymo istorija:</h4>
                    <p class="figure-caption">Paskutinių 10, sąskaitos papildymų istorija:</p>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Nr.</th>
                            <th scope="col">Kiekis</th>
                            <th scope="col">Papildymo data</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php history($userid); ?>
                        </tbody>
                    </table>
                </form>
                <p class="">Šiuo metu sąskaitoje turite: <?php echo $coinsleft; ?>, iš viso esate pridėjęs: <?php echo $coinshad; ?>.</p>
                <p class=""><a href="profile.php" class="btn btn-primary">Peržiūrėti profilį</a></p>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php  if (empty($_SESSION['email'])) { header("location: login.php"); } ?>
<?php include_once 'footer.php'; ?>