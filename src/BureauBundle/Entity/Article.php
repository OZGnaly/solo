<?php

namespace BureauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 *@ORM\Entity(repositoryClass="BureauBundle\Entity\ArticleRepository")
 * @ORM\HasLifecycleCallBacks()
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=100)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Auteur", type="string", length=80)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="secretariat", type="string", length=100)
     * @ORM\ManyToOne (targetEntity="BureauBundle\Entity\Secretariat", inversedBy="Secretariat")
     * @ORM\JoinColumn( nullable=true)
     */
    private $secretariat;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="text")
     */
    private $contenu;


    private $image;
    /**
     * @var date
     *
     * @ORM\Column(name="date_edition", type="datetime", nullable = true)
     */
    private $dateEdtition;
    /**
     * @var date
     *
     * @ORM\Column(name="date_mod", type="datetime", nullable=true)
     */
    private $datemodif;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Article
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set secretariat
     *
     * @param string $secretariat
     * @return Article
     */
    public function setSecretariat($secretariat)
    {
        $this->secretariat = $secretariat;

        return $this;
    }

    /**
     * Get secretariat
     *
     * @return string 
     */
    public function getSecretariat()
    {
        return $this->secretariat;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Article
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Article
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set dateEdtition
     *
     * @param \DateTime $dateEdtition
     * @return Article
     */
    public function setDateEdtition($dateEdtition)
    {
        $this->dateEdtition = $dateEdtition;

        return $this;
    }

    /**
     * Get dateEdtition
     *
     * @return \DateTime 
     */
    public function getDateEdtition()
    {
        return $this->dateEdtition;
    }

    /**
     * Set datemodif
     *
     * @param \DateTime $datemodif
     * @return Article
     */
    public function setDatemodif($datemodif)
    {
        $this->datemodif = $datemodif;

        return $this;
    }

    /**
     * Get datemodif
     *
     * @return \DateTime 
     */
    public function getDatemodif()
    {
        return $this->datemodif;
    }

    public function __construct()
    {
        $this->setDateEdtition( new \DateTime) ;
        $this->setDatemodif( new \DateTime) ;

    }
    /**
     * @ORM\preUpdate
     * Callback pour mettre à jour la date d'édition à chaque
    modification de l'entité
     */
    public  function updateDate()
    {
        $this->setDatemodif( new \DateTime());
    }

}
