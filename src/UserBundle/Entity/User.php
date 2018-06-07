<?php
namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
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
     * @var string The presentation of the user.
     * @Serializer\Expose(true)
     * @Serializer\Type("string")
     * @ORM\Column(name="presentation", type="string", nullable=true)
     */
    protected $presentation;

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

    public function sendNotificationByEmail($content){
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "test@votredomaine.com";
        $to = "lalance.paul@gmail.com";
        $subject = "Message de l'administrateur";
        $message = "Cher ".$this->getUsername().", <br>".$content;
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
    }

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * @param string $presentation
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
    }
}
