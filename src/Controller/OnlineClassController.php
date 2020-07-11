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
     * @Rest\Get("/api/advertisement")
     */
    public function sampleClassAction(Request $request, OnlineClassRepository $onlineClassRepository)
    {   
        $class = $request->query->get('class') ? $request->query->get('class') : null ;

        if($class){
            $liveClassQuery = $onlineClassRepository->findBy(['isLive' => true,'class' => $class ],['id' => 'DESC'],1 ,0);        
        }
        else
            $liveClassQuery = $onlineClassRepository->findBy(['isLive' => true ],['id' => 'DESC'],1 ,0);        
            
        if($liveClassQuery)
            $result = $liveClassQuery[0];
        else
            $result = null;

        $response = [];

        if($result)
        {
            // $response['live'] = $result;
            $httpCode = Response::HTTP_OK;

            $response['message'] = 'Class is live';
            $response['title'] = $result->getName();
            $response['youtubeUrl'] = $result->getVideoUrl();
            $response['description'] = $result->getDescription();
         
        } else {
            $httpCode = Response::HTTP_NO_CONTENT;
            $response['message'] = 'No live class is going on. Try again later';
            
        }

        return [
            'code' => $httpCode,
            'data' => $response
        ];
    }

    /**
     * @Route("/sugarcube", name="online_class_test")
     */
    public function index(OnlineClassRepository $onlineClassRepository)
    {
        $videosList = $onlineClassRepository->findVideosList();

        return $this->render('online_class/classList.html.twig', [
            'classes' => $videosList,
        ]);
    }

    /**
     * @Rest\Get("/api/class/{class}")
     */
    public function listAction(Request $request, OnlineClassRepository $onlineClassRepository,string $class = '')
    {   
        $response = [];

        if($class) 
        {
            $liveClassQuery = $onlineClassRepository->findBy(['isLive' => true,'class' => $class ],['id' => 'DESC'],1 ,0);

            if($liveClassQuery)
                $liveVideo = $liveClassQuery[0];
            else
                $liveVideo = null;

            if($liveVideo)
            {
                $response['live'] = $liveVideo;
                $httpCode = Response::HTTP_OK;
            
            } else {
                $response['live']['message'] = 'No live class is going on. Try again later';
                $httpCode = Response::HTTP_NO_CONTENT;
            }

            $recordedClasses = $onlineClassRepository->findBy(
                ['isListed' => true, 'isLive' => false, 'class' => $class],['id' => 'DESC']
            );

            $response['recorded'] = $recordedClasses;

        } else {
            $httpCode = Response::HTTP_MULTIPLE_CHOICES;
            $response['classList'] = $onlineClassRepository->findExistingClasses();
        }

        return [
            'code' => $httpCode,
            'data' => $response
        ];
    }

    /**
     * @Rest\Get("/api/class/{class}/live-video")
     */
    public function liveVideoAction(Request $request, OnlineClassRepository $onlineClassRepository,string $class)
    {   
        //defaulting class to 1 in case parameter is not set
        $class = $class ? $class : 1 ;

        if($class)
            $liveClassQuery = $onlineClassRepository->findBy(['isLive' => true,'class' => $class ],['id' => 'DESC'],1 ,0);
        else
            $liveClassQuery = $onlineClassRepository->findBy(['isLive' => true ],['id' => 'DESC'],1 ,0);
            
        if($liveClassQuery)
            $result = $liveClassQuery[0];
        else
            $result = null;

        $response = [];

        if($result)
        {
            $response = $result;
            $httpCode = Response::HTTP_OK;
         
        } else {
            $response['message'] = 'No live class is going on. Try again later';
            $httpCode = Response::HTTP_NO_CONTENT;
        }

        return [
            'code' => $httpCode,
            'data' => $response
        ];
    }

    /**
     * @Rest\Get("/api/class/{class}/recorded-videos")
     */
    public function recordedVideosAction(Request $request, OnlineClassRepository $onlineClassRepository,string $class)
    {   
        //defaulting class to 1 in case parameter is not set
        $class = $class ? $class : 1 ;
        
        $recordedClasses = $onlineClassRepository->findBy(
            ['isListed' => true, 'isLive' => false, 'class' => $class],['id' => 'DESC']
        );

        $response = [];

        if($recordedClasses)
        {
            $response = $recordedClasses;
            $httpCode = Response::HTTP_OK;
         
        } else {
            $response['message'] = 'No classes recorded yet';
            $httpCode = Response::HTTP_NO_CONTENT;
        }

        return [
            'code' => $httpCode,
            // 'items' => count($result), 
            'data' => $response
        ];
    }

}
