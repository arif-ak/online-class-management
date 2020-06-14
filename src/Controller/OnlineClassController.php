<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\OnlineClass;
use App\Repository\OnlineClassRepository;

class OnlineClassController extends AbstractController
{
    /**
     * @Route("/test", name="online_class_test")
     */
    public function index()
    {
        return $this->render('online_class/index.html.twig', [
            'controller_name' => 'OnlineClassController',
        ]);
    }

    /**
     * @Rest\Get("/api/class")
     */
    public function listAction(Request $request, OnlineClassRepository $onlineClassRepository)
    {   
        //defaulting class to 1 in case parameter is not set
        $class = $request->query->get('class') ? $request->query->get('class') : 1 ;

        if($class)
            $liveClassQuery = $onlineClassRepository->findBy(['isLive' => true,'class' => $class ],['id' => 'DESC'],1 ,0);
        else
            $liveClassQuery = $onlineClassRepository->findBy(['isLive' => true ],['id' => 'DESC'],1 ,0);
        
        $recordedClasses = $onlineClassRepository->findBy(
            ['isListed' => true, 'isLive' => false, 'class' => $class],['id' => 'DESC']
        );
            
        if($liveClassQuery)
            $result = $liveClassQuery[0];
        else
            $result = null;

        $response = [];

        

        if($result)
        {
            $response['live'] = $result;
            $httpCode = Response::HTTP_OK;

            // $response['message'] = 'Class is live';
            // $response['title'] = $result->getName();
            // $response['youtubeUrl'] = $result->getVideoUrl();
            // $response['description'] = $result->getDescription();
            // $response['class'] = $result->getClass();
         
        } else {
            $response['live']['message'] = 'No live class is going on. Try again later';
            $httpCode = Response::HTTP_NO_CONTENT;
        }

        $response['recorded'] = $recordedClasses;

        return [
            'code' => $httpCode,
            // 'items' => count($result), 
            'data' => $response
        ];
    }

}
