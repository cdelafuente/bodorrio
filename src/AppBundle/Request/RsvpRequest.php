<?php

namespace AppBundle\Request;

use Symfony\Component\HttpFoundation\Request;

class RsvpRequest
{

  /** @var Request */
  private $request;

  /**
   * @param Request $request
   */
  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function fullName()
  {
    return $this->request->get('full-name', '');
  }

  public function isAttending()
  {
    $isAttending = $this->request->get('attending', 'no');
    return  $isAttending == 'yes' ? true : false;
  }

  public function isGuestAttending()
  {
    $isGuestAttending = $this->request->get('guest-attending', 'no');
    return $isGuestAttending == 'yes' ? true : false;
  }

  public function guestName()
  {
    return $this->request->get('guest-name', '');
  }

  public function areChildrenAttending()
  {
    $areChildrenAttending = $this->request->get('children-attending', 'no');
    return $areChildrenAttending == 'yes' ? true : false;
  }

  public function childrenNumber()
  {
    $childrenNumber = $this->request->get('children-number', '');
    return empty($childrenNumber) ? 0 : $childrenNumber;
  }

}