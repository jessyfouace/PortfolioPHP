<?php
include("template/header.php"); ?>

<?php 
if (!isset($_SESSION['nocookies'])) {
    if (!isset($_COOKIE['acceptation'])) { ?>
<div style="border-radius: 0px; position: fixed; bottom: -20px; z-index: 49999; width: 100%;" class="alert alert-secondary">
    <div class="row col-12 m-0 p-0">
        <p class="col-10" style="color: black;">Ce site utilise des cookies de connection ainsi qu'un cookie pour ce souvenir de votre choix dans l'acceptation. Si vous validez ce message les cookies seront accepté si vous refusez les cookies seront non autoriser.</p>
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="submit" name="acceptcookies" class="btn btn-primary" value="J'accepte">
            <input type="submit" name="refusecookies" class="btn btn-danger" value="Je refuse">
        </form>
    </div>
</div>
<?php 
} else {
    $_SESSION['nocookies'] = 'true';
}
} ?>

<div class="col-11 mx-auto height100vh d-flex">
    <form action="connectForAdminPannelPortfolio.php" method="post" class="col-12 mx-auto my-auto">
        <p class="<?php echo $color ?> text-center"><?php echo $message ?></p>
        <div class="col-11 col-md-5 mx-auto m-0 p-0 colorwhite">
        <input class="effect-1 col-12 m-0 nobg" type="text" name="pseudo" placeholder="Pseudonyme">
        <span class="focus-border"></span>
    </div>
    <div class="col-11 col-md-5 mx-auto m-0 p-0 colorwhite mt-5">
        <input class="effect-1 col-12 m-0 nobg" type="password" name="password" placeholder="Mot de passe">
        <span class="focus-border"></span>
    </div>
    <?php if (isset($_COOKIE['acceptation'])) { ?>
    <div class="custom-control custom-checkbox col-11 col-md-5 mx-auto m-0 p-0 mt-5">
        <input type="checkbox" class="custom-control-input" id="customCheck" name="cookies">
        <label class="custom-control-label ml-4" for="customCheck" style="color: #ddd">Se souvenir de moi ?</label>
    </div>
    <?php } ?>
    <div class="col-11 col-md-5 mx-auto m-0 mb-5 p-0 d-flex mt-2">
        <input class="my-auto mx-auto btn btn-primary" type="submit" name="connexion" value="Connection">
    </div>
</form>
</div>

<?php include("template/footer.php");
