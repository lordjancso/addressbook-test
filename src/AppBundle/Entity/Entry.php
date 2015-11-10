<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\SoftDeleteableEntity;
use AppBundle\Entity\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entry
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EntryRepository")
 * @Gedmo\SoftDeleteable
 */
class Entry
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var EntryAddress[]
     *
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EntryAddress", mappedBy="entry", cascade={"persist", "remove"})
     */
    private $addresses;

    /**
     * @var EntryEmail[]
     *
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EntryEmail", mappedBy="entry", cascade={"persist", "remove"})
     */
    private $emails;

    /**
     * @var EntryPhone[]
     *
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EntryPhone", mappedBy="entry", cascade={"persist", "remove"})
     */
    private $phones;

    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Entry
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add address
     *
     * @param \AppBundle\Entity\EntryAddress $address
     *
     * @return Entry
     */
    public function addAddress(\AppBundle\Entity\EntryAddress $address)
    {
        $this->addresses[] = $address;
        $address->setEntry($this);

        return $this;
    }

    /**
     * Remove address
     *
     * @param \AppBundle\Entity\EntryAddress $address
     */
    public function removeAddress(\AppBundle\Entity\EntryAddress $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Add email
     *
     * @param \AppBundle\Entity\EntryEmail $email
     *
     * @return Entry
     */
    public function addEmail(\AppBundle\Entity\EntryEmail $email)
    {
        $this->emails[] = $email;
        $email->setEntry($this);

        return $this;
    }

    /**
     * Remove email
     *
     * @param \AppBundle\Entity\EntryEmail $email
     */
    public function removeEmail(\AppBundle\Entity\EntryEmail $email)
    {
        $this->emails->removeElement($email);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add phone
     *
     * @param \AppBundle\Entity\EntryPhone $phone
     *
     * @return Entry
     */
    public function addPhone(\AppBundle\Entity\EntryPhone $phone)
    {
        $this->phones[] = $phone;
        $phone->setEntry($this);

        return $this;
    }

    /**
     * Remove phone
     *
     * @param \AppBundle\Entity\EntryPhone $phone
     */
    public function removePhone(\AppBundle\Entity\EntryPhone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }
}
