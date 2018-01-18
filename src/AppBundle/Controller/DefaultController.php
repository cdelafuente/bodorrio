<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Confirmation;
use AppBundle\Request\RsvpRequest;
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
    $rsvpRequest = new RsvpRequest($request);

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

      $confirmation = $this->saveConfirmation($rsvpRequest);

      return $this->render(
        'default/rsvp.html.twig',
        [
          'confirmed' => !empty($confirmation),
          'previouslyConfirmed' => empty($confirmation)
        ]
      );
    }

    return $this->render(
      'default/rsvp.html.twig',
      [
        'confirmed' => false,
        'previouslyConfirmed' => false
      ]
    );
  }

  /**
   * @param RsvpRequest $request
   * @return Confirmation|null
   */
  private function saveConfirmation(RsvpRequest $request)
  {
    $service = new ConfirmationService($this->getDoctrine()->getManager());

    if ($service->attendeeExists($request->fullName()))
    {
      return null;
    }

    return $service->addConfirmation(
      (new Confirmation())
        ->setFullName($request->fullName())
        ->setAttending($request->isAttending())
        ->setGuestAttending($request->isGuestAttending())
        ->setGuestName($request->guestName())
        ->setChildrenAttending($request->areChildrenAttending())
        ->setChildrenNumber($request->childrenNumber())
    );
  }

}
