<?php
$q = $_REQUEST["q"];
if($q == 1){
    echo "<h4 class=\"text-info\">Sėkmingai papildėte sąskaitą.</h4>";

} else {
    echo '<h4 class="text-danger"><i class="fa fa-ban text-danger" aria-hidden="true"></i> Neteisigas papildymo kodas.</h4>';
}
?>