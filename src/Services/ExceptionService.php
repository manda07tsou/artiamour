<?php
namespace App\Services;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;

class ExceptionService{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function error404(string $message = "la page n'existe pas"){
        $content = $this->twig->render("pages/error_404.html.twig", 
            ["message" => $message]
        );
        return new Response($content, 404);
    }
}