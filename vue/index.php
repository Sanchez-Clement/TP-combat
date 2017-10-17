<ul>

  <?php foreach ($persos as $perso): ?>
    <li><?php echo $perso->getNom() ?> : <?php echo $perso->getDegats() ?> </li>
  <?php endforeach; ?>

</ul>
<form action="" method="post">
     <p>
       <label for="nom">nom</label>
       <input type="text" name="nom" maxlength="50" id="non" />
       <input type="submit" value="Créer ce personnage" name="creer" />

     </p>
   </form>
  <?php
if (isset($error)) {echo "<p>" . $error . "</p>";}
   ?>
<form class=""  method="post">
  <select class="" name="attaquant">
    <?php foreach ($persos as $perso): ?>
      <option value="<?php echo $perso->getId() ?>"><?php echo $perso->getNom() ?></option>
    <?php endforeach; ?>

  </select>
  <p>attaque contre</p>
  <select class="" name="adversaire">
    <?php foreach ($persos as $perso): ?>
      <option value="<?php echo $perso->getId() ?>"><?php echo $perso->getNom() ?></option>
    <?php endforeach; ?>
<input type="submit" value="Lancer attaque" name="attaque" />
  </select>
</form>

<form class=""  method="post">
  <input type="submit" name="reset" value="Remettre à 0 les dégats">
</form>
