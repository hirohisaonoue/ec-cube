<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{
    /**
     * @Route("/hello", name="hello")
     */
    public function index()
    {
        $result = <<< EOM
        <html>
        <head><title>Hello</title></head>
        <body>
        <h1>Hello Symfony</h1>
        <p>３５ページまできた</p>
        </body>
        </html>
        EOM;
        return new Response($result);
    }
}

#use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
#use Symfony\Component\Routing\Annotation\Route;

#class HelloController extends AbstractController
#{
#    /**
#     * @Route("/hello", name="hello")
#     */
#    public function index()
#    {
#        return $this->render('hello/index.html.twig', [
#            'controller_name' => 'HelloController',
#        ]);
#    }
#}
