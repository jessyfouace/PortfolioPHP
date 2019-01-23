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

    <div class="col-12 row m-0 p-0 pt-2 mt-5">
      <div class="maincol-12 col-md-3 p-0 m-0">
        <aside>
          <div class="sidebar left">
            <div>
              <div class="row m-0 p-2">
                <p>Bonjour <?php echo $_SESSION['pseudo']; ?></p>
              </div>
            </div>
            <ul class="list-sidebar bg-defoult">
              <li> <a href="#" data-toggle="collapse" data-target="#dashboard" class="collapsed active" > <i class="fa fa-th-large"></i> <span class="nav-label"> Menu </span> <span class="fa fa-chevron-left pull-right"></span> </a>
              <ul class="sub-menu collapse" id="dashboard">
                <li><a href="admin.php?add=true" class=" col-12"><i class="fas fa-plus-circle"> Ajouter un projet</i></a></li>
                <li><a href="admin.php?update=true" class=" col-12"><i class="fas fa-edit"> Modifier un projet</i></a></li>
                <li><a href="admin.php?remove=true" class=" col-12"><i class="fas fa-trash-alt"> Supprimer un projet</i></a></li>
                <li><a href="admin.php?contact=true" class=" col-12"><i class="fas fa-envelope"> Contact</i></a></li>
              </ul>
            </li>
            </ul>
          </div>
        </aside>
      </div>
      <div class="col-12 col-md-9 overflow">
        <?php if (isset($_GET['add'])) {
    if ($_GET['add'] == 'true') {
        ?><p class="font-weight-bold text-center <?php echo $color ?>"><?php echo $message; ?></p>
            <form action="admin.php?add=true" method="post" class="col-11 mx-auto row" enctype="multipart/form-data">
                <div class="col-11 col-md-5 mx-auto m-0 p-0 colorwhite">
                    <input class="effect-1 col-12 m-0 nobg" type="text" name="name" placeholder="Nom (Obligatoire)" required>
                    <span class="focus-border"></span>
                </div>
                <div class="col-11 col-md-5 mx-auto m-0 p-0 colorwhite">
                    <input class="effect-1 col-12 m-0 nobg" type="text" name="link" placeholder="Github">
                    <span class="focus-border"></span>
                </div>
                <div class="col-11 mx-auto m-0 p-0 colorwhite">
                  <textarea class="effect-1 col-12 m-0 nobg" name="description" placeholder="Description.. (Obligatoire)" cols="30" rows="5" required></textarea>
                  <span class="focus-border"></span>
                </div>
                <div class="col-11 mx-auto m-0 p-0 colorwhite">
                    <input type="file" name="image" id="image">
                </div>
                <div class="col-5 mx-auto m-0 mb-5 mt-2 p-0 d-flex">
                    <input class="my-auto mx-auto btn btn-primary" type="submit" name="submit" value="Envoyer">
                </div>
            </form>
          <?php
    }
} elseif (isset($_GET['update'])) {
    if ($_GET['update'] == 'true') {
        ?>
          <table id="mytable" class="table table-bordred table-striped">           
          <thead class="colorwhite"> 
              <th>Nom</th>
              <th>Lien</th>
              <th>Description</th>
              <th>Ancienne Image</th>
              <th>Nouvelle Image</th>
              <th>Éditer</th>
          </thead>
          <tbody>
         <?php foreach ($showAll as $project) {
            ?>
          <form action="admin.php?update=true&project=<?php echo $project->getTitle(); ?>" method="post" enctype="multipart/form-data">
            <tr class="colorwhite">
              <td><input name="name" class="colorblack" type="text" value="<?php echo $project->getTitle(); ?>"></td>
              <td><input name="link" class="colorblack" type="text" value="<?php echo $project->getLink(); ?>"></td>
              <td><textarea name="description" class="colorblack" id="" cols="30" rows="5"><?php echo $project->getDescription(); ?></textarea></td>
              <td><img name="lastimage" style="width: 100px;" src="<?php echo $project->getImage() ?>" alt="Image"></td>
              <td><input type="file" name="image" id="image"></td>
              <td><input type="hidden" value="<?php echo $project->getId(); ?>" name="id">
                  <input class="btn btn-primary" type="submit" name="submit" value="Éditer">
              </td>
            </tr>
         </form>
      <?php
        } ?>
        </tbody>
        </table>
     <?php
    }
} elseif (isset($_GET['remove'])) {
    if ($_GET['remove'] == 'true') {
        ?>
      <table id="mytable" class="table table-bordred table-striped">           
          <thead class="colorwhite"> 
              <th>ID</th>
              <th>Nom</th>
              <th>Lien</th>
              <th>Image</th>
              <th>Supprimer</th>
          </thead>
          <tbody>
         <?php foreach ($showAll as $project) {
            ?>
          <tr class="colorwhite">
              <td><?php echo $project->getId() ?></td>
              <td><?php echo $project->getTitle() ?></td>
              <td><?php echo $project->getLink() ?></td>
              <td><img style="width: 100px;" src="<?php echo $project->getImage() ?>" alt="Image"></td>
              <td><form action="admin.php?remove=true" method="post">
                <input type="hidden" value="<?php echo $project->getId(); ?>" name="id">
                <input class="btn btn-danger" type="submit" name="submit" value="Supprimer">
              </form>
              </td>
            </tr>
      <?php
        } ?>
        </tbody>
        </table>
    <?php
    }
} elseif (isset($_GET['contact'])) {
    if ($_GET['contact'] == 'true') {
        ?>
<div class="container col-12 m-0 p-0">
  <div class="row">
    <div class="col-12 m-0 p-0">
      <div class="table-responsive">          
        <table id="mytable" class="table table-bordred table-striped">           
          <thead class="colorwhite"> 
              <th>ID</th>
              <th>Prénom</th>
              <th>Nom</th>
              <th>Téléphone</th>
              <th>Email</th>
              <th>Message</th>
              <th>Voir</th>  
              <th>Supprimer</th>
          </thead>
          <tbody>
          <?php foreach ($takeMessages as $message) {
            ?>
            <tr class="colorwhite">
              <td><?php echo $message->getId() ?></td>
              <td><?php echo $message->getFirstname() ?></td>
              <td><?php echo $message->getLastname() ?></td>
              <td>0<?php echo $message->getPhone() ?></td>
              <td><?php echo $message->getEmail() ?></td>
              <td><?php echo substr($message->getMessage(), 0, 10) ?>...</td>
              <td>
                <input type="hidden" value="<?php echo $message->getId(); ?>" name="id">
                <input class="btn btn-primary" type="button" value="Voir">
              </td>
              <td><form action="admin.php?contact=true&deleteMessage=true" method="post">
                    <input type="hidden" value="<?php echo $message->getId(); ?>" name="id">
                    <input class="btn btn-danger" type="submit" value="Supprimer">
                  </form>
              </td>
            </tr>
            <?php
        } ?>
          </tbody>
        </table>           
      </div>        
    </div>
	</div>
</div>  
     <?php
    }
} ?>


<?php include("template/footer.php");
