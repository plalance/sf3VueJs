<?php
namespace SiteBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Appareil
 *
 * @ORM\Table(name="appareil")
 * @ORM\Entity(repositoryClass="SiteBundle\Repository\AppareilRepository")
 */
class Appareil
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_appareil", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var int
     *
     * @ORM\Column(name="label", type="string", nullable=false)
     */
    protected $label;

    /**
     * @var String
     *
     * @ORM\Column(name="power", type="string", nullable=false)
     */
    protected $power;

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
     * @return int
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param int $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param mixed $power
     */
    public function setPower($power)
    {
        $this->power = $power;
    }
}
