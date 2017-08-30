<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tracking")
 */
class Tracking
{
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $trackingId;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $emailAddress;

  /**
   * @ORM\Column(type="datetime")
   */
  private $createDate;

  public function __construct()
  {
    $this->createDate = new DateTime();
  }

  /**
   * @return int
   */
  public function getTrackingId()
  {
    return $this->trackingId;
  }

  /**
   * @return string
   */
  public function getEmailAddress()
  {
    return $this->emailAddress;
  }

  /**
   * @return DateTime
   */
  public function getCreateDate()
  {
    return $this->createDate;
  }

  /**
   * @param string $emailAddress
   * @return Tracking
   */
  public function setEmailAddress($emailAddress)
  {
    $this->emailAddress = $emailAddress;
    return $this;
  }

  /**
   * @param DateTime $createDate
   * @return Tracking
   */
  public function setCreateDate(DateTime $createDate)
  {
    $this->createDate = $createDate;
    return $this;
  }
}