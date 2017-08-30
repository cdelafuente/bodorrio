<?php

namespace AppBundle\Response;


use Symfony\Component\HttpFoundation\Response;

class TransparentPixelResponse extends Response
{
  const CONTENT_IMG = 'R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==';
  const CONTENT_TYPE = 'image/gif';

  public function __construct()
  {
    $content = base64_decode(self::CONTENT_IMG);
    parent::__construct($content);

    $this->headers->set('Content-Type', self::CONTENT_TYPE);
    $this->setPrivate();
    $this->headers->addCacheControlDirective('no-cache', true);
    $this->headers->addCacheControlDirective('must-revalidate', true);
  }
}