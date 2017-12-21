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
   * @param Request $request
   * @return TransparentPixelResponse
   */
  public function trackEmail(Request $request)
  {
    $email = $request->query->get('email');
    $type = $request->query->get('type');

    if ($this->shouldTrackEmail($email, $type))
    {
      $em = $this->getDoctrine()->getManager();

      $tracking = (new Tracking())
        ->setEmailAddress($email)
        ->setType(!empty($type) ? $type : null);

      $em->persist($tracking);
      $em->flush();
    }

    return new TransparentPixelResponse();
  }

  /**
   * @param string $email
   * @param string $type
   * @return bool
   */
  private function shouldTrackEmail($email, $type)
  {
    if (empty($email))
    {
      return false;
    }

    if (empty($type))
    {
      return false;
    }

    if ($this->trackingRecordExists($email, $type))
    {
      return false;
    }

    return true;
  }

  /**
   * @param string $email
   * @param $type
   * @return bool
   */
  private function trackingRecordExists($email, $type)
  {
    $repository = $this->getDoctrine()->getRepository(Tracking::class);
    $tracking = $repository->findOneBy(
      [
        'emailAddress' => $email,
        'type' => $type
      ]
    );

    return !empty($tracking);
  }

}