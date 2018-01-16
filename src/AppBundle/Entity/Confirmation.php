<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="confirmation")
 */
class Confirmation
{

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $confirmationId;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $fullName;

  /**
   * @ORM\Column(type="boolean")
   */
  private $attending;

  /**
   * @ORM\Column(type="boolean", nullable=true)
   */
  private $guestAttending;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $guestName;

  /**
   * @ORM\Column(type="boolean", nullable=true)
   */
  private $childrenAttending;

  /**
   * @ORM\Column(type="integer", nullable=true)
   */
  private $childrenNumber;

  /**
   * @ORM\Column(type="datetime")
   */
  private $creationDate;

  public function __construct()
  {
    $this->creationDate = new DateTime();
  }

  /**
   * @return mixed
   */
  public function getConfirmationId()
  {
    return $this->confirmationId;
  }

  /**
   * @return mixed
   */
  public function getFullName()
  {
    return $this->fullName;
  }

  /**
   * @return mixed
   */
  public function getAttending()
  {
    return $this->attending;
  }

  /**
   * @return mixed
   */
  public function getGuestAttending()
  {
    return $this->guestAttending;
  }

  /**
   * @return mixed
   */
  public function getGuestName()
  {
    return $this->guestName;
  }

  /**
   * @return mixed
   */
  public function getChildrenAttending()
  {
    return $this->childrenAttending;
  }

  /**
   * @return mixed
   */
  public function getChildrenNumber()
  {
    return $this->childrenNumber;
  }

  /**
   * @return mixed
   */
  public function getCreationDate()
  {
    return $this->creationDate;
  }

  /**
   * @param int $confirmationId
   * @return Confirmation
   */
  public function setConfirmationId($confirmationId)
  {
    $this->confirmationId = $confirmationId;
    return $this;
  }

  /**
   * @param string $fullName
   * @return Confirmation
   */
  public function setFullName($fullName)
  {
    $this->fullName = $fullName;
    return $this;
  }

  /**
   * @param boolean $attending
   * @return Confirmation
   */
  public function setAttending($attending)
  {
    $this->attending = $attending;
    return $this;
  }

  /**
   * @param boolean $guestAttending
   * @return Confirmation
   */
  public function setGuestAttending($guestAttending)
  {
    $this->guestAttending = $guestAttending;
    return $this;
  }

  /**
   * @param string $guestName
   * @return Confirmation
   */
  public function setGuestName($guestName)
  {
    $this->guestName = $guestName;
    return $this;
  }

  /**
   * @param boolean $childrenAttending
   * @return Confirmation
   */
  public function setChildrenAttending($childrenAttending)
  {
    $this->childrenAttending = $childrenAttending;
    return $this;
  }

  /**
   * @param int $childrenNumber
   * @return Confirmation
   */
  public function setChildrenNumber($childrenNumber)
  {
    $this->childrenNumber = $childrenNumber;
    return $this;
  }

  /**
   * @param DateTime $creationDate
   * @return Confirmation
   */
  public function setCreationDate($creationDate)
  {
    $this->creationDate = $creationDate;
    return $this;
  }

}