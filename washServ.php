<?php include('server.php') ?>
<?php
$wash = $_REQUEST["w"];
$box = $_REQUEST["b"];
$userid = $_REQUEST["ui"];

if($userid){
    useCoin($wash,$box,$userid);
    echo "<h4 class=\"text-info\">Panaudojote 1 žetoną.</h4>";
    coinsLeft($userid);
} else {
    echo '<h4 class="text-danger"><i class="fa fa-ban text-danger" aria-hidden="true"></i>Įvyko klaida.</h4>';
}
?>