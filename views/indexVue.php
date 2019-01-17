<?php
include("template/header.php"); ?>

<div class="height100vh col-12 m-0 p-0 d-flex">
  <div class="height100vh col-12 m-0 p-0 d-flex row">
  <div class="height50vh my-auto bgvague text-center d-flex">
  </div>
  <div style="z-index: 10" class="height100vh col-12 text-center position-absolute d-flex">
    <img class="imageresponsive my-auto mx-auto" src="../assets/img/noobspacetest.png" alt="test">
  </div>
  <div style="width: 100%; height: 50vh;" class="height50vh my-auto secondbgvague text-center d-flex">
  </div>
</div>
</div>

<div class="line text-center col-10 mx-auto mt-5">
  <span id="realisation" class="h1 pl-1 pr-1">Mes Réalisations</span>
</div>

<div class="col-11 mx-auto row p-0 m-0">

<?php
$calcul = 0;
foreach ($getProjects as $project) {
    $calcul++; ?>
    
<div class="col-12 col-md-7 mx-auto view overlay zoom mt-5 heightpx" <?php if ($calcul&1) {
        ?> data-aos="fade-left" <?php
    } else {
        ?> data-aos="fade-right" <?php
    } ?>data-aos-duration="1500">
    <div class="hovereffect">
        <img style="width: 100%; height: 110%" class="img-responsive" src="<?php echo $project->getImage(); ?>" alt="">
            <div class="overlay">
                <h2 class="sizephone"><?php echo $project->getTitle(); ?></h2>
                <p class="icon-links sizephone">
                    <a class="ml-2 p-1" href="detail.php?project=<?= $project->getId() ?>">
                        <span>Voir plus</span>
                    </a>
                    <?php if ($project->getLink() !== "") {
        ?>
                    <a class="ml-2 p-1" target="_blank" href="<?php echo $project->getLink(); ?>">
                        <span>Code</span>
                    </a>
                    <?php
    } ?>
                </p>
            </div>
    </div>
</div>
<?php
}
?>

</div>

<div class="line text-center col-10 mx-auto mt-5">
  <span id="about" class="h1 pl-1 pr-1">A Propos</span>
</div>

<div class="line text-center col-10 mx-auto mt-5">
  <span id="contact" class="h1 pl-1 pr-1">Me Contacter</span>
</div>

<p class="<?php echo $color ?> text-center"><?php echo $message ?></p>
<form action="index.php#contact" method="post" class="col-11 mx-auto row">
    <div class="col-11 col-md-5 mx-auto m-0 p-0 colorwhite mt-2 formone">
        <input class="effect-1 col-12 m-0 nobg" type="text" name="firstname" placeholder="Nom (Obligatoire)" required>
        <span class="focus-border"></span>
    </div>
    <div class="col-11 col-md-5 mx-auto m-0 p-0 colorwhite mt-2 formone">
        <input class="effect-1 col-12 m-0 nobg" type="text" name="lastname" placeholder="Prénom (Obligatoire)" required>
        <span class="focus-border"></span>
    </div>
    <div class="col-11 col-md-5 mx-auto m-0 p-0 colorwhite mt-2 formtwo">
        <input class="effect-1 col-12 m-0 nobg" type="tel" name="phone" placeholder="Téléphone">
        <span class="focus-border"></span>
    </div>
    <div class="col-11 col-md-5 mx-auto m-0 p-0 colorwhite mt-2 formtwo">
        <input class="effect-1 col-12 m-0 nobg" type="email" name="mail" placeholder="E-mail (Obligatoire)" required>
        <span class="focus-border"></span>
    </div>
    <div class="col-11 mx-auto m-0 p-0 colorwhite mt-2 formtree">
        <textarea class="effect-1 col-12 m-0 nobg" name="message" placeholder="Sujet.. (Obligatoire)" cols="30" rows="5" required></textarea>
        <span class="focus-border"></span>
    </div>
    <div class="col-5 mx-auto m-0 mb-5 mt-2 p-0 d-flex formfor">
        <input class="my-auto mx-auto btn btn-primary" type="submit" name="send" value="Envoyer">
    </div>
</form>

<?php include("template/footer.php");
