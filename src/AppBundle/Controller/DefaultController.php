<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Confirmation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

  const ERROR_FULL_NAME_REQUIRED = 'Nombre completo requerido';
  const ERROR_ATTENDANCE_REQUIRED = 'Asistencia requerida';

  /**
   * @Route("/", name="homepage")
   */
  public function indexAction(Request $request)
  {
    return $this->render('default/index.html.twig');
  }

  /**
   * @Route("/details/attire", name="details")
   */
  public function attireAction(Request $request)
  {
    return $this->render('default/details.html.twig');
  }

  /**
   * @Route("/details/wedding", name="wedding")
   */
  public function weddingAction(Request $request)
  {
    return $this->render('default/wedding.html.twig');
  }

  /**
   * @Route("/accommodations", name="accommodations")
   */
  public function accommodationsAction(Request $request)
  {
    return $this->render('default/accommodations.html.twig');
  }

  /**
   * @Route("/rsvp", name="rsvp")
   */
  public function rsvpAction(Request $request)
  {
    $errors = [];

    if ($request->getMethod() === Request::METHOD_POST)
    {
      if (!$request->get('full-name', null))
      {
        $errors[] = self::ERROR_FULL_NAME_REQUIRED;
      }

      if (!$request->get('attending', null))
      {
        $errors[] = self::ERROR_ATTENDANCE_REQUIRED;
      }

      if (!empty($errors))
      {
        return $this->render(
          'default/rsvp.html.twig',
          [
            'errors' => $errors
          ]
        );
      }

      $em = $this->getDoctrine()->getManager();

      $confirmation = (new Confirmation())
        ->setFullName($request->get('full-name', null))
        ->setAttending($request->get('attending', false) == 'yes' ? true : false)
        ->setGuestAttending($request->get('guest-attending', false) == 'yes' ? true: false)
        ->setGuestName($request->get('guest-name', ''))
        ->setChildrenAttending($request->get('children-attending', false) == 'yes' ? true : false)
        ->setChildrenNumber($request->get('children-number', null));

      $em->persist($confirmation);
      $em->flush();

      return $this->render(
        'default/rsvp.html.twig',
        [
          'confirmed' => true
        ]
      );
    }

    return $this->render('default/rsvp.html.twig');
  }

}
