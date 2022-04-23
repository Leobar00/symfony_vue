<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Colonna;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ColumnController extends AbstractController
{



    /**
     * @Route("/ajax/create-column", name="create_column")
     */
    public function create(EntityManagerInterface $entityManager,Request $request): Response
    {
        if ($request->isXmlHttpRequest() || $request->isMethod('post')) {
            $data = $request->getContent();
            $data = json_decode($data, true);
            
            $name = $data['name'];


            $column = new Colonna();
            $column->setName($name);
        
            $entityManager->persist($column);
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
    


    /**
     * @Route("/ajax/column-all", name="all_column")
     */
    public function allFields(EntityManagerInterface $entityManager)
    {
        
        $column   = $entityManager->getRepository(Colonna::class)->findAll();
        $encoders = [new JsonEncoder()]; // If no need for XmlEncoder
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        

        // Serialize your object in Json
        $jsonObject = $serializer->serialize($column, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        
        return $this->json(json_decode($jsonObject));

    }

    /**
     * @Route("/ajax/column/delete", name="delete_column")
     */
    public function deleteAction(EntityManagerInterface $entityManager,Request $request)
    {
        if ($request->isXmlHttpRequest() || $request->isMethod('post')) {

            $data = $request->getContent();
            $data = json_decode($data, true);
            
            $id = $data['id'];
            $column = $entityManager->getRepository(Colonna::class)->find($id);

            $entityManager->remove($column);
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
    
}
