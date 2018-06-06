<?php
namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     */
    protected $username;

    /**
     * @var string The email of the user.
     *
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @var bool
     * @Serializer\Expose(true)
     */
    protected $enabled;

    /**
     * @var \DateTime|null
     * @Serializer\Expose(true)
     */
    protected $lastLogin;

    /**
     * @var array
     * @Serializer\Expose(true)
     */
    protected $roles;

    public function __construct()
    {
        parent::__construct();
    }

}
