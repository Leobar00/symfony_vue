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
use App\Entity\Colonna;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;



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
    public function getFieldId(EntityManagerInterface $entityManager,Request $request)
    {
        
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
     * @Route("/ajax/create", name="create")
     */
    public function create(EntityManagerInterface $entityManager,Request $request): Response
    {
        if ($request->isXmlHttpRequest() || $request->isMethod('post')) {
            $data = $request->getContent();
            $data = json_decode($data, true);
            
            $title = $data['title'];
            $description = $data['description'];
            $idColumn = $data['idColumn'];
             
            $column = $entityManager->getRepository(Colonna::class)->find($idColumn);

            $card = new Card();
            $card->setTitle($title)
                ->setDescription($description)
                ->setColonna($column);

           
            $entityManager->persist($card);
            $entityManager->flush();
            

            $jsonData = array(
                'status'   => 'success',
                'column-id'=> json_encode($idColumn)
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
    public function allFields(EntityManagerInterface $entityManager,SerializerInterface $serializer)
    {

        $card = $entityManager->getRepository(Card::class)->findAll();

        $encoders = [new JsonEncoder()]; // If no need for XmlEncoder
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        // Serialize your object in Json
        $jsonObject = $serializer->serialize($card, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        return $this->json(json_decode($jsonObject));


    }

    /**
     * @Route("/ajax/update-card", name="ajax_update")
     */
    public function updateCard(EntityManagerInterface $entityManager,Request $request)
    {
        if ($request->isXmlHttpRequest() || $request->isMethod('post')) { 
            
            $data = $request->getContent();
            $data = json_decode($data, true);

            $id = $data['id'];
            $title = $data['titleInfo'];
            $description = $data['descriptionInfo'];

            
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
            return new Response(json_encode($jsonData)); 
        }
        $jsonData = array(
            'status' => 'error'
        );

        return new Response(json_encode($jsonData));

    }

    /**
     * @Route("/ajax/delete", name="delete")
     */
    public function deleteAction(EntityManagerInterface $entityManager,Request $request)
    {
        if ($request->isXmlHttpRequest() || $request->isMethod('post')) {

            $data = $request->getContent();
            $data = json_decode($data, true);
            
            $id = $data['id'];
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
    


    private function sendResponse($success,$type)
    {

        $data = array(
            "success" => $success,
            "type"    => $type  
        );

        return new JsonResponse([
            "data"  => $data
        ]);
    }

}