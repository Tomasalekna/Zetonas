<?php include_once 'adminHeader.php'; ?>
<!-- Page Content Holder -->
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

    <h2>Žetonas.lt administravimo panelė</h2>
    <p>Sveiki prisijungę prie žetonas.lt administravimo panelės. Čia galite atlikti tam tikrus veiksmus susijusius su Jūsų plovyklos administravimu, tokius kaip: ataskaitos peržiūrėjimas, vartotojų redagavimas.</p>

    <div class="line"></div>

    <h2>Jūsų plovyklos informacija: </h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nr.</th>
            <th scope="col">Pavadinimas</th>
            <th scope="col">Įmonės kodas</th>
            <th scope="col">PVM kodas</th>
            <th scope="col">Adresas</th>
            <th scope="col">Tel. numeris</th>
        </tr>
        </thead>
        <tbody>
        <?php company($admin_id); ?>
        </tbody>
    </table>

</div>
</div>
<?php include_once 'admin_footer.php'; ?>
