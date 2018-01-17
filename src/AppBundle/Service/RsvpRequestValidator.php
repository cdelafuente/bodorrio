<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class RsvpRequestValidator
{

  const ERROR_FULL_NAME_REQUIRED = 'Nombre completo requerido';
  const ERROR_ATTENDANCE_REQUIRED = 'Asistencia requerida';
  const ERROR_GUEST_NAME_REQUIRED = 'Nombre de el o la acompañante requerido';
  const ERROR_CHILDREN_NUMBER_REQUIRED = 'Numero de niños requerido';
  const ERROR_CHILDREN_NUMBER_INVALID = 'Numero de niños invalido';

  /** @var Request */
  private $request;

  /**
   * @param Request $request
   */
  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  /**
   * @return array
   */
  public function validate()
  {
    $errors = [];

    if (empty($this->request->get('full-name', null)))
    {
      $errors[] = self::ERROR_FULL_NAME_REQUIRED;
    }

    if (empty($this->request->get('attending', null)))
    {
      $errors[] = self::ERROR_ATTENDANCE_REQUIRED;
    }

    $isGuestAttending = $this->request->get('guest-attending');

    if ($isGuestAttending == 'yes')
    {
      $guestName = $this->request->get('guest-name', null);

      if (empty($guestName))
      {
        $errors[] = self::ERROR_GUEST_NAME_REQUIRED;
      }
    }

    $areChildrenAttending = $this->request->get('children-attending');

    if ($areChildrenAttending == 'yes')
    {
      $childrenNumber = $this->request->get('children-number', null);

      if (empty($childrenNumber))
      {
        $errors[] = self::ERROR_CHILDREN_NUMBER_REQUIRED;
      }
      else
      {
        if (!is_numeric($childrenNumber))
        {
          $errors[] = self::ERROR_CHILDREN_NUMBER_INVALID;
        }
      }
    }

    return $errors;
  }

}