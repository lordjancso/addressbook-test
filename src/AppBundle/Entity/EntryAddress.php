<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\SoftDeleteableEntity;
use AppBundle\Entity\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * EntryAddress
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EntryAddressRepository")
 * @Gedmo\SoftDeleteable
 */
class EntryAddress
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
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var Entry
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Entry", inversedBy="addresses")
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
     * Set address
     *
     * @param string $address
     *
     * @return EntryAddress
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set entry
     *
     * @param \AppBundle\Entity\Entry $entry
     *
     * @return EntryAddress
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
