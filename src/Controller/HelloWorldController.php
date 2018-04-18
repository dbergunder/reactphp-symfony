<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class HelloWorldController
 * @Method({"GET"})
 */
class HelloWorldController
{
    /**
     * @Route("/")
     */
    public function index(Request $request) : Response
    {
        return new Response('Hello World');
    }
}