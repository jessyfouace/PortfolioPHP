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

<p class="colorred pt-3 font-weight-bold text-center sizeforphone"><?= $message ?></p>
<div class="mt-5 pt-3">
    <div class="row col-12 col-md-11 m-0 p-0">
        <div class="col-12 col-md-6 m-0 p-0 text-center">
            <img style="width: 95%; height: 100%" src="<?php echo $getProjects->getImage(); ?>" alt="">
        </div>
        <div class="col-12 col-md-6">
            <h1 class="colorandsize"><?= $getProjects->getTitle(); ?></h1>
            <p><?= $getProjects->getDescription() ?></p>
            <a class="btn btn-primary" href="<?= $getProjects->getLink() ?>">Github</a>
        </div>
    </div>
</div>

<?php include("template/footer.php");
