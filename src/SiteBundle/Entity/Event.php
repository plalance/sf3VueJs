<?php
namespace SiteBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="SiteBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var int
     *
     * @Serializer\Expose(true)
     * @Serializer\Type("int")
     * @ORM\Column(name="id_event", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"application", "admin"})
     */
    protected $id;

    /**
     * @var Location
     *
     * Localisation de l'évènement
     * @Serializer\Expose(true)
     *
     * @ORM\ManyToOne(targetEntity="SiteBundle\Entity\Location", inversedBy="events")
     * @ORM\JoinColumn(name="id_location", referencedColumnName="id_location")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"application", "admin"})
     */
    private $location;

    /**
     * @var String
     *
     * Nom de l'évènement
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @ORM\Column(name="name", type="string", nullable=false)
     * @Groups({"application", "admin"})
     */
    protected $name;

    /**
     * @var String
     *
     * Icone Google Map
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @ORM\Column(name="icon", type="string", nullable=true)
     * @Groups({"application", "admin"})
     */
    protected $icon;

    /**
     * Event constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param String $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
}
