<?php
/**
 *
 */
class Personnage
{
    private $_id;
    private $_nom;
    private $_degats;


    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = "set" . $key ;
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getNom()
    {
        return $this->_nom;
    }


    public function getDegats()
    {
        return $this->_degats;
    }


    public function setNom($nom)
    {
        if (is_string($nom) && !empty($nom)) {
            $this->_nom = $nom;
        }
    }

    public function setId_personnage($id)
    {
        $this->_id = (int) $id ;
    }

    public function setDegats($degats)
    {
        $degats = (int) $degats;
        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }

    public function attaquer($adversaire)
    {
        $adversaire ->_degats += 5;
        if ($adversaire ->_degats >= 100) {
            echo $this->_nom . " a tué " . $adversaire->_nom;
        } else {
            echo $this->_nom . " attaque" . $adversaire->_nom . " ! ( Son dégat est maintenant de " . $adversaire->_degats . " )";
        }
    }
}
