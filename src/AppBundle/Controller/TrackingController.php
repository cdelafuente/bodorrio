<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tracking;
use AppBundle\Response\TransparentPixelResponse;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TrackingController extends Controller
{
  /**
   * @Route("/track.gif", name="track")
   */
  public function trackEmail(Request $request)
  {
    $email = $request->query->get('email');

    if (!is_null($email) && !$this->emailExists($email))
    {
      $em = $this->getDoctrine()->getManager();

      $tracking = (new Tracking())->setEmailAddress($email);

      $em->persist($tracking);
      $em->flush();
    }

    return new TransparentPixelResponse();
  }

  private function emailExists($email)
  {
    $repository = $this->getDoctrine()->getRepository(Tracking::class);
    $tracking = $repository->findOneBy(
      ['emailAddress' => $email]
    );

    return !empty($tracking);
  }
}