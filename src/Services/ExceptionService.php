<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ExceptionService{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function error404(string $message = "la page que vous chercher n'existe pas"){
        $content = $this->twig->render("pages/error_404.html.twig", 
            ["message" => $message]
        );
        return new Response($content, 404);
    }
}