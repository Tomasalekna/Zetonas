<?php include_once 'adminHeader.php'; ?>
<!-- Page Content Holder -->
<?php
if (!isset($_POST["date"])) {
    $dateSel = "CURDATE()";
} else {$dateSel = $_POST["date"];} ?>
<div id="content">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="navbar-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <small>Šiandien yra: <?php echo date("Y.m.d");?></small>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2>Ataskaita</h2><a href="adminReportPrint.php?date=<?php echo $dateSel;?>" target="_blank">Spausdinti <i class="fa fa-print"></i></a>
    <form action="admin_reports.php" method="post" id="dataSelect">
        <div class="input-group">
            <select class="custom-select" name="date" form="dataSelect" onchange="this.form.submit()" required>
                <option value="">Pasirinkite laikotarpį</option>
                <option value="CURDATE()">Dienos</option>
                <option value="CURRENT_DATE - INTERVAL 1 MONTH">Menesio</option>
                <option value="CURRENT_DATE - INTERVAL 1 YEAR">Metų</option>
            </select>
        </div>
    </form>
    <?php reportSum($dateSel); ?>
    <small> <?php reportSumByBox($dateSel,1); reportSumByBox($dateSel,2); reportSumByBox($dateSel,3);?></small>

    <div class="line"></div>

    <h2>Detali ataskaita:</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nr.</th>
            <th scope="col">Data</th>
            <th scope="col">Plovimo aikštelė</th>
            <th scope="col">Panaudota žetonų</th>
        </tr>
        </thead>
        <tbody>
        <?php report($dateSel); ?>
        </tbody>
    </table>

</div>
</div>
<?php include_once 'admin_footer.php'; ?>
