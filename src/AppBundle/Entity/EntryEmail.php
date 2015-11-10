<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\SoftDeleteableEntity;
use AppBundle\Entity\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * EntryEmail
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EntryEmailRepository")
 * @Gedmo\SoftDeleteable
 */
class EntryEmail
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var Entry
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entry", inversedBy="emails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entry;

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
     * Set email
     *
     * @param string $email
     *
     * @return EntryEmail
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set entry
     *
     * @param \AppBundle\Entity\Entry $entry
     *
     * @return EntryEmail
     */
    public function setEntry(\AppBundle\Entity\Entry $entry = null)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get entry
     *
     * @return \AppBundle\Entity\Entry
     */
    public function getEntry()
    {
        return $this->entry;
    }
}
