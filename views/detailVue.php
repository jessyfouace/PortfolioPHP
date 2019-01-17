<?php
include("template/header.php"); ?>
<p class="colorred pt-3 font-weight-bold text-center sizeforphone"><?= $message ?></p>
<div class="mt-5 pt-3">
    <div class="row col-12 col-md-11 m-0 p-0 formone">
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
