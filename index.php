<?php include_once 'header.php'; ?>

<div class="container">
    <div class="container-fluid">
        <div class="row">
        <h3>Apie projektą</h3>
            <p>Žetonas.Lt tai sistema, kuri Jums leis paprastai ir greitai įsigyti žetonus ir kurios pagalba galėsite nusiplauti automobilį nenaudodamas senų metalinių žetonų. Kodėl tai patogu?</p>
            <ul>
                <li>Nebereikės vežiotis metalinių žetonų.</li>
                <li>Visada žinosi savo žetonų likutį.</li>
                <li>Papildysi žetonų sąskaitą akimirksniu.</li>
                <li>Saugai gamtą, nes nebenaudoji metalinių monetų.</li>
            </ul>
            <?php if (empty($_SESSION['email'])) : ?>
                <p>O dabar tau tereikia <a href="login.php">prisijungti</a> ir naudotis šiomis nuostabiomis paslaugomis. Dar neturi paskyros? <a href="register.php">Registruokis</a>.</p>
            <?php endif ?>
            <?php  if (isset($_SESSION['email'])) : ?>
        </div>
                <div class="row">
                    <p>Jūs jau esate prisijungęs, taigi spauskite mygtuką <a class="btn btn-outline-primary" href="wash.php">Plauti</a> ir pradėkite naudotis visomis galimybėmis.</p>
                </div>
            <?php endif ?>
    </div>
</div>

<?php include_once 'footer.php'; ?>