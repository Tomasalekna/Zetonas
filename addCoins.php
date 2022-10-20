
<?php include_once 'header.php'; ?>
<?php  if (isset($_SESSION['email'])) : ?>
<?php include('server.php') ?>
<?php
    if(empty($_SESSION['coinshad'])){$coinshad = 0;} else {$coinshad = $_SESSION['coinshad'];};
    if(empty($_SESSION['coinsleft'])){$coinsleft = 0;} else {$coinsleft = $_SESSION['coinsleft'];};

?>

<div class="container">
    <div class="card card-container">

        <div class="text-center">
                <h4>Papildyti sąskaitai įveskite kodą:</h4>
                <p class="figure-caption">Papildymo kodą galite įsigyti kasoje, adresu: Tunelio g. 26, Kaunas.</p>
                <div class="input-group mb-3" id="adding">
                    <input type="text" class="form-control" placeholder="Pirmi 8 simboliai">
                    <input type="text" class="form-control" placeholder="Likę 6 simboliai">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" onclick="send(2)">Papildyti</button>
                    </div>
                </div>
            <p id="addingcoinsreturn"></p>
            <p class="">Šiuo metu sąskaitoje turite: <?php echo $coinsleft; ?>, iš viso esate pridėjęs: <?php echo $coinshad; ?>.</p>
            <p class=""><a href="profile.php" class="btn btn-primary">Peržiūrėti profilį</a></p>
        </div>
    </div>
</div>




<?php endif; ?>

<?php  if (empty($_SESSION['email'])) {
    header("location: login.php");
}
?>
<?php include_once 'footer.php'; ?>
<script>
    function send(str) {
        var myRequest = new XMLHttpRequest();
        myRequest.open("GET", "addCoinsServ.php?q=" + str, true);
        myRequest.onreadystatechange = function () {
            if (myRequest.readyState === 4) {
                document.getElementById('addingcoinsreturn').innerHTML = myRequest.responseText;
                //document.getElementById('adding').innerHTML = "";
            }
        };
        myRequest.send();
    }
</script>