<?php
  include("template/header.php"); ?>

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
    <div class="col-11 col-md-5 mx-auto m-0 mb-5 p-0 d-flex mt-5">
        <input class="my-auto mx-auto btn btn-primary" type="submit" name="connexion" value="Connection">
    </div>
</form>
</div>

<?php include("template/footer.php");
