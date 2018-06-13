<?php
namespace SiteBundle\Entity;
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
     * @Serializer\Expose(true)
     * @Serializer\Type("int")
     * @ORM\Column(name="id_location", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"application", "admin"})
     */
    protected $id;

    /**
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="latitude", type="float", nullable=true)
     * @Groups({"application", "admin"})
     */
    protected $latitude;

    /**
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="longitude", type="float", nullable=true)
     * @Groups({"application", "admin"})
     */
    protected $longitude;


    /**
     * Location constructor.
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
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
}
