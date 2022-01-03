<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Card;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
     /**
     * @Route("/", name="home_FE")
     * 
     */
    public function indexAction(EntityManagerInterface $entityManager): Response
    {

        $card = $entityManager->getRepository(Card::class)->findAll();
        

        return $this->render('base.html.twig', [
            "cards"           => $card,
            'controller_name' => 'HomepageController',
        ]);
    }

     

    /**
     * @Route("/fieldId", name="fieldId")
     */
    public function getFieldId(EntityManagerInterface $entityManager,Request $request){
        
        if ($request->isXmlHttpRequest() || $request->isMethod('get')) {
            $id = $request->request->get('id');
            $card = $entityManager->getRepository(Card::class)->find($id);

            $title = $card->getTitle();
            $description = $card->getDescription();
            
            
            $data = array(
                'id'            => $id,
                'title'         => $title,
                'description'   => $description
            );

            return new Response(json_encode($data));
        }

        $data = array(
            'status' => 'error'
        );

        return new Response(json_encode($data));


    }



    /**
     * @Route("/create", name="create")
     */
    public function create(EntityManagerInterface $entityManager,Request $request): Response
    {
        if ($request->isXmlHttpRequest() || $request->isMethod('post')) {
            $title = $request->request->get('title');
            $description = $request->request->get('description');


            $card = new Card();
            $card->setTitle($title)
                ->setDescription($description);
        

            if(!is_null($title)){
                $entityManager->persist($card);
                $entityManager->flush();
            }

            $id = $card->getId();

            $jsonData = array(
                'id'    => $id,
                'title' => $title,
                'description' => $description
            );
            return new Response(json_encode($jsonData)); 
        }

        $jsonData = array(
            'status' => 'error'
        );

        return new Response(json_encode($jsonData));


    }
    


    /**
     * @Route("/ajax/field-info", name="ajax_field")
     */
    public function allFields(EntityManagerInterface $entityManager){

        $card = $entityManager->getRepository(Card::class)->findAll();
    
        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new 
        JsonEncoder()));
        $json = $serializer->serialize($card, 'json');
        $response = json_decode($json);
        

        return $this->json($response);


    }

    public function updateCard(EntityManagerInterface $entityManager,Request $request){
        if ($request->isXmlHttpRequest() || $request->isMethod('put')) { 
            $id = $request->request->get('id');
            $title = $request->request->get('title-info');
            $description = $request->request->get('description-info');
            
            $card = $entityManager->getRepository(Card::class)->find($id);

            $card->setTitle($title)
                ->setDescription($description);

            if(!is_null($title)){
                $entityManager->persist($card);
                $entityManager->flush();
            }


            $jsonData = array(
                'status' => 'success'
            );
            return new JsonResponse($jsonData); 
        }

    }

    /**
     * @Route("/delete", name="delete")
     */
    public function deleteAction(EntityManagerInterface $entityManager,Request $request){
        if ($request->isXmlHttpRequest() || $request->isMethod('delete')) {

            $id = $request->request->get('id');
            $card = $entityManager->getRepository(Card::class)->find($id);

            $entityManager->remove($card);
            $entityManager->flush();

            $jsonData = array(
                'status' => 'success'
            );
            return new Response(json_encode($jsonData)); 
        }   

        $jsonData = array(
            'status' => 'error'
        );

        return new Response(json_encode($jsonData));

    }


    private function sendResponse($success,$type){

        $data = array(
            "success" => $success,
            "type"    => $type  
        );

        return new JsonResponse([
            "data"  => $data
        ]);
    }

}