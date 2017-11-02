<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Pais;
class PaisController extends FOSRestController
{

    /**
     * @Rest\Get("/paises")
     */
    public function paisesAction(Request $request)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        // repo películas
        $repoPaises = $em->getRepository('AppBundle:Pais');
        $output = array();

        $paises = $repoPaises->findAll();

        if ($paises) {
            foreach($paises as $pais) {

                //categoría


                //paises
                $output[] = array(
                    'id'          => $pais->getId(),
                    'nombre'      => $pais->getNombre(),
                );
            }
            return new View($output, Response::HTTP_OK);
        } else {
            return new View('No existen película aun.', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Get("/paises/{id}")
     */
    public function paisAction(Request $request, $id)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        // repo películas
        $repoPais = $em->getRepository('AppBundle:Pais');
        $output = array();

        // busca la película
        $pais = $repoPais->find($id);

        if ($pais) {



            //paises
            $output = array(
                'id'          => $pais->getId(),
                'nombre'      => $pais->getNombre(),

            );

            return new View($output, Response::HTTP_OK);
        } else {
            return new View('Película no encontrada', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Post("/paises")
     */
    public function postPaisAction(Request $request)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        //parametros de la petición
        $nombre = $request->request->get('nombre');

        // entidad
        $pais = new Pais();
        $pais->setNombre($nombre);

        // persistencia
        try {
            $em->persist($pais);
            $em->flush();
            return new View('Creación satisfactoria.', Response::HTTP_CREATED);
        } catch (exception $e) {
            return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Put("/paises/{id}")
     */
    public function putPaisAction(Request $request, $id)
    {
        // entity manager y repo
        $em = $this->getDoctrine()->getManager();
        $repoPais = $em->getRepository('AppBundle:Pais');

        //parametros de la petición
        $nombre = $request->request->get('nombre');

        // entidad
        $pais = $repoPais->find($id);
        $pais->setNombre($nombre);

        // persistencia
        try {
            $em->persist($pais);
            $em->flush();
            return new View('Actualizacion satisfactoria.', Response::HTTP_CREATED);
        } catch (exception $e) {
            return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\Delete("/paises/{id}")
     */
    public function deletePaisAction(Request $request, $id)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        //repo  y entidad paises
        $repoPais = $em->getRepository('AppBundle:Pais');
        $pais= $repoPais->find($id);

        if ($pais) {
            // eliminacion
            $em->remove($pais);
            $em->flush();
            return new View("Eliminación satisfactoria", Response::HTTP_OK);
        } else {
            return new View('Película no encontrada', Response::HTTP_NOT_FOUND);
        }
    }


}
