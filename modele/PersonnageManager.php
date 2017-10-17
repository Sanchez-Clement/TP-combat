<?php
/**
 *
 */
class PersonnageManager
{
    private $bdd;


    public function __construct($bdd)
    {
        $this->setBdd($bdd);

    }

    public function Add(Personnage $perso)
    {
        $req = $this->_bdd->prepare('INSERT INTO Personnages(nom) VALUES(:nom)');
        $req->execute(array(
          'nom' => $perso->getNom()
    ));

    $perso->hydrate([
      'id' => $this->_bdd->lastInsertId(),
      'degats' => 0,
    ]);
    }

    public function existeNom($nom)
    {
      $req = $this->_bdd->prepare('SELECT COUNT(*) FROM Personnages WHERE nom = :nom');
   $req->execute([':nom' => $nom]);

   return (bool) $req->fetchColumn();


    }

    public function Delete(Personnage $perso)
    {
      $this->_bdd->exec('DELETE FROM Personnages WHERE id_personnage = '.$perso->id());
    }

    public function Update(Personnage $perso)
    {
      $req = $this->_bdd->prepare('UPDATE Personnages SET degats = :degats WHERE id_personnage = :id');
      $req->execute(array(
        'degats' => $perso->getDegats() ,
        'id' => $perso->getId()
      ));
    }

    public function ResetAllDegats(Personnage $perso)
    {
      $req = $this->_bdd->prepare('UPDATE Personnages SET degats = :degats WHERE id_personnage = :id');
      $req->execute(array(
        'degats' => 0,
        'id' => $perso->getId()
      ));
    }

    public function getList()
    {
      $persos = [];

    $req = $this->_bdd->query('SELECT id_personnage, nom, degats FROM Personnages ORDER BY nom');

    while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
    {
      $persos[] = new Personnage($donnees);
    }

    return $persos;
    }

    public function get($id)
    {
      $id = (int) $id;

    $req = $this->_bdd->query('SELECT id_personnage, nom,  degats FROM Personnages WHERE id_personnage = '.$id);
    $donnees = $req->fetch(PDO::FETCH_ASSOC);

    return new Personnage($donnees);
    }



    public function setBdd($bdd)
    {
        $this->_bdd = $bdd;
    }
}
