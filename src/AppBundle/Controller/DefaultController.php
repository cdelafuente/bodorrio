<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

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

}
