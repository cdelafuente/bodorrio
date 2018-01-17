<?php

namespace AppBundle\Service;

use AppBundle\Entity\Confirmation;
use Doctrine\Common\Persistence\ObjectManager;

class ConfirmationService
{

  /** @var ObjectManager */
  private $manager;

  /**
   * @param ObjectManager $manager
   */
  public function __construct(ObjectManager $manager)
  {
    $this->manager = $manager;
  }

  /**
   * @param Confirmation $confirmation
   * @return Confirmation
   */
  public function addConfirmation(Confirmation $confirmation)
  {
    $this->manager->persist($confirmation);
    $this->manager->flush();

    return $confirmation;
  }

  /**
   * @param string $fullName
   * @return bool
   */
  public function attendeeExists($fullName)
  {
    $repository = $this->manager->getRepository(Confirmation::class);
    $confirmation = $repository->findOneBy(
      [
        'fullName' => $fullName
      ]
    );

    return !empty($confirmation);
  }

}