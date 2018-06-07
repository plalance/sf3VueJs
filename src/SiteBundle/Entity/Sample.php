<?php
namespace SiteBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * Sample
 *
 * @ORM\Table(name="sample")
 * @ORM\Entity(repositoryClass="SiteBundle\Repository\SampleRepository")
 */
class Sample
{
    /**
     * @var int
     * @Serializer\Expose(true)
     * @Serializer\Type("int")
     * @ORM\Column(name="id_sample", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"application", "admin"})
     */
    protected $id;

    /**
     * @var String
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="label", type="string", nullable=false)
     * @Groups({"application", "admin"})
     */
    protected $label;

    /**
     * @var String
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="description", type="string", nullable=false)
     * @Groups({"application", "admin"})
     */
    protected $description;

    /**
     * @var int
     * @Serializer\Expose()
     * @Serializer\Type("int")
     * @ORM\Column(name="age", type="integer")
     * @Groups({"admin"})
     */
    protected $age;

    /**
     * Sample constructor.
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
     * @return String
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param String $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
}
