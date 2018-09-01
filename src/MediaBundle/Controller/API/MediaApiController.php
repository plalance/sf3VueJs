<?php

namespace MediaBundle\Controller\API;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Swagger\Annotations as SWG;

class MediaApiController extends Controller
{

    /**
     * Récupérer tous les médias
     * @SWG\Response(
     *     response=200,
     *     description="Get All Medias",
     * )
     * @SWG\Parameter(
     *     name="content",
     *     in="query",
     *     type="string",
     *     description="content (POST) will be used for the body of the mail"
     * )
     * @SWG\Tag(name="Media")
     */
    public function GetMediasAction(Request $request)
    {

    }

}
