<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Confirmation;
use AppBundle\Service\ConfirmationService;
use AppBundle\Service\RsvpRequestValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

  const CONFIRMATION_EMAIL_SUBJECT = 'Confirmacion de Asistencia Boda D&D';
  const CONFIRMATION_EMAIL_SENDER = 'rsvp@bodorrio-dany-daniel.com';

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
    if ($request->getMethod() === Request::METHOD_POST)
    {
      $validator = new RsvpRequestValidator($request);
      $errors = $validator->validate();

      if (!empty($errors))
      {
        return $this->render(
          'default/rsvp.html.twig',
          [
            'errors' => $errors,
            'confirmed' => false,
            'previouslyConfirmed' => false
          ]
        );
      }

      $confirmation = $this->saveConfirmation($request);

      return $this->render(
        'default/rsvp.html.twig',
        [
          'previouslyConfirmed' => empty($confirmation),
          'confirmed' => !empty($confirmation)
        ]
      );
    }

    return $this->render(
      'default/rsvp.html.twig',
      [
        'previouslyConfirmed' => false,
        'confirmed' => false
      ]
    );
  }

  /**
   * @param Request $request
   * @return Confirmation|null
   */
  private function saveConfirmation(Request $request)
  {
    $service = new ConfirmationService($this->getDoctrine()->getManager());

    if ($service->attendeeExists($request->get('full-name')))
    {
      return null;
    }

    return $service->addConfirmation(
      (new Confirmation())
        ->setFullName($request->get('full-name', null))
        ->setAttending($request->get('attending', false) == 'yes' ? true : false)
        ->setGuestAttending($request->get('guest-attending', false) == 'yes' ? true: false)
        ->setGuestName($request->get('guest-name', ''))
        ->setChildrenAttending($request->get('children-attending', false) == 'yes' ? true : false)
        ->setChildrenNumber($request->get('children-number', null))
    );
  }

}
