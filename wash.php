<?php include_once 'header.php'; ?>
<?php  if (isset($_SESSION['email'])) : ?>
<?php include('server.php') ?>
<?php
    $email = $_SESSION['email'];
    $userid = $_SESSION['userid'];
    if (isset($_POST["wash"])) {$wash = $_POST["wash"];} else {$wash = 0;};
    if(isset($_POST["box"])){$box = $_POST["box"];} else {$box = 0;};
    if(empty($_SESSION['coinshad'])){$coinshad = 0;} else {$coinshad = $_SESSION['coinshad'];};
    if(empty($_SESSION['coinsleft'])){$coinsleft = 0;} else {$coinsleft = $_SESSION['coinsleft'];};
?>
<div class="container">
    <div class="card card-container">
        <div class="text-center">
            <form action="wash.php" method="post" id="carwash">
                <div class="input-group">
                    <select name="wash" form="carwash" class="custom-select" id="inputGroupSelect04" required>
                        <option value="">Pasirinkite plovyklą</option>
                        <option value="1" <?php if($wash=="1"){echo "selected";} else {echo "";}?>>Tunelio g.</option>
                        <option value="2" <?php if($wash=="2"){echo "selected";} else {echo "";}?>>Islandijos pl.</option>
                        <option value="kursiu" <?php if($wash=="kursiu"){echo "disabled";} else {echo "disabled";}?>>Kuršių g.</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn <?php if($box==1){echo "btn-secondary";} else {echo "btn-outline-secondary";}?>" type="submit" name="box" value="1">1</button>
                        <button class="btn <?php if($box==2){echo "btn-secondary";} else {echo "btn-outline-secondary";}?>" type="submit" name="box" value="2">2</button>
                        <button class="btn <?php if($box==3){echo "btn-secondary";} else {echo "btn-outline-secondary";}?>" type="submit" name="box" value="3">3</button>
                    </div>
                </div>
            </form>
            <div class="profile-img-card wash <?php if($coinsleft < 1 && $wash < 1){echo "disabled";};?>"  id="profile-img">
                <?php if($coinsleft > 0){
                    if($wash > 0){
                        echo '<input class="wash-button" type="button" name="clickMe" id="alertTimerButton" value="Plauti!" onclick="alertTimerClickHandler()"/>';
                    } else { echo "<h4></h4>";}
                } else {
                    echo "<h4>Neturite pakankamai žetonų</h4>";
                }
                    ?>
            </div>
            <p class="figure-caption text-justify"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Paspaudę mygtuką Plauti, turėsite tris sekundes operacijai atšaukti.</p>
            <p id="addingcoinsreturn"></p>
            <p id="coinsleft">Liko žetonų: <?php echo $coinsleft; ?> iš <?php echo $coinshad; ?></p>
            <p class=""><a href="addCoins.php" class="btn btn-primary"><i class="fa fa-eur" aria-hidden="true"></i> Papildyk žetonus</a></p>
        </div>
    </div>
</div>
<script type="text/javascript">
    var alertTimerId = 0;
    function alertTimerClickHandler()
    {
        if (document.getElementById("alertTimerButton").value == "Plauti!")
        {
            // Start the timer
            document.getElementById("alertTimerButton").value = "Atšaukti!";
            document.getElementById("alertTimerButton").style.backgroundColor = 'red';
            alertTimerId = setTimeout ( "showAlert()", 3000 );
        } else {
            document.getElementById("alertTimerButton").value = "Plauti!";
            document.getElementById("alertTimerButton").style.backgroundColor = '#28a745';
            clearTimeout ( alertTimerId );
        }
    }
    function showAlert()
    {
        document.getElementById("alertTimerButton").value = "Plauti!";
        document.getElementById("alertTimerButton").style.backgroundColor = '#28a745';
        send(<?php echo $wash, ",", $box, ",", $userid; ?>);
    }
    function send(wash, box, userid) {
            var myRequest = new XMLHttpRequest();
            myRequest.open("GET", "washServ.php?w=" + wash + "&b=" + box + "&ui=" + userid, true);
            myRequest.onreadystatechange = function () {
                if (myRequest.readyState === 4) {
                    document.getElementById('addingcoinsreturn').innerHTML = myRequest.responseText;
                    document.getElementById('coinsleft').innerHTML = '';
                }
            };
            myRequest.send();
        }
</script>
<?php
    include_once 'footer.php';
    endif;
    if (empty($_SESSION['email'])) {header("location: login.php");}
?>