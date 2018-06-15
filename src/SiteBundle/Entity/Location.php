<?php
namespace SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="SiteBundle\Repository\LocationRepository")
 */
class Location
{
    /**
     * @var int
     *
     * @Serializer\Expose(true)
     * @Serializer\Type("int")
     * @ORM\Column(name="id_location", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"application", "admin"})
     */
    protected $id;

    /**
     * @var string
     *
     * Nom du lieu (donné par user)
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="name", type="string", nullable=false)
     * @Groups({"application", "admin"})
     */
    protected $name;

    /**
     * @var string
     *
     * Adresse Generique
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="address_name", type="string", nullable=true)
     * @Groups({"application", "admin"})
     */
    protected $addressName;

    /**
     * @var float
     *
     * Latitude
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="latitude", type="float", nullable=false)
     * @Groups({"application", "admin"})
     */
    protected $latitude;

    /**
     * @var float
     *
     * Longitude
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="longitude", type="float", nullable=false)
     * @Groups({"application", "admin"})
     */
    protected $longitude;

    /**
     * @var ArrayCollection
     *
     * Les évènements qui se sont déroulés ici
     * @Serializer\Expose
     * @ORM\OneToMany(targetEntity="SiteBundle\Entity\Event", mappedBy="location")
     * @Groups({"application", "admin"})
     */
    private $events;

    /**
     * @var String
     *
     * Icone Google Map
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @ORM\Column(name="icon", type="string", nullable=true)
     * @Groups({"application", "admin"})
     */
    protected $iconForGoogleMap;


    /**
     * Location constructor.
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function __toString() {
        return $this->getName();
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
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param ArrayCollection $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @return String
     */
    public function getIconForGoogleMap()
    {
        return $this->iconForGoogleMap;
    }

    /**
     * @param String $iconForGoogleMap
     */
    public function setIconForGoogleMap($iconForGoogleMap)
    {
        $this->iconForGoogleMap = $iconForGoogleMap;
    }

    /**
     * Add event
     *
     * @param \SiteBundle\Entity\Event $event
     *
     * @return Location
     */
    public function addEvent(\SiteBundle\Entity\Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param \SiteBundle\Entity\Event $event
     */
    public function removeEvent(\SiteBundle\Entity\Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddressName()
    {
        return $this->addressName;
    }

    /**
     * @param string $addressName
     */
    public function setAddressName($addressName)
    {
        $this->addressName = $addressName;
    }
}
