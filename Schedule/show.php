<?php
include_once("templates/header.php");
?>
<div class="container" id="view-contact-container">
    <?php include_once("templates/backbtn.html");?>
    <h1 id="mains-title"><?= $contact["name"] ?></h1>
    <p class="fw-bold">Telefone:</p>
    <p><?= $contact["phone"] ?></p>
    <p class="fw-bold">E-mail:</p>
    <p><?= $contact["email"] ?></p>
    <p class="fw-bold">Observações:</p>
    <p><?= $contact["observations"] ?></p>
</div>
<?php
include_once("templates/footer.php")
?>