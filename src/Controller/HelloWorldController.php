<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request) : JsonResponse
    {
        $response = sprintf(
            'This kernel has handled %d requests since initiation.',
            $request->attributes->get('count', 0)
        );
        return new JsonResponse($response);
    }
}