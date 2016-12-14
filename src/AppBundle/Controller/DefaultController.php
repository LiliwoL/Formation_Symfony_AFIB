<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpKernel\Exception\HttpException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/hello", name="hello")
     */
    public function helloAction(Request $request)
    {
        die("hello");
    }

    public function hello2Action(Request $request)
    {
        die("Route hello2");
    }

    /**
    * @Method( {"GET"} )
    * @Route(
    *   "/hello/{name}",
    *   name="Route_hello_someone",
    *   requirements={
    *       "name": "fabrice|sylvia"
    *   })
    */
    public function helloSomeoneAction(Request $request)
    {
       // Récupération du nom
       $name = $request->attributes->get('name');

        return new Response(
           '<html><body>Route Hello Someone hello: '.$name.'</body></html>'
       );
    }

    /**
    * @Route("/helloRouteNew", name="helloRoute")
    */
    public function helloRouteAction(Request $request)
    {
        return $this->redirectToRoute('Route_hello_someone',array('name' => 'sylvia'));
    }


    /**
    * @Route("/helloRouteErreur", name="helloRouteErreur")
    */
    public function helloRouteErreurAction(Request $request)
    {
    	// recherche de l'article
        $article = null;

        // Test de l'article
        if ( !$article) {
        	throw new HttpException(
            	404,
                'Cet article n`existe pas du tout'
            );
        }else{
            return new Response(
               '<html><body>Article trouvé!</body></html>'
           );
        }
    }


    /**
     * @Route("/helloVue", name="Hello Vue")
     */
    public function helloVueAction(Request $request)
    {
        // Vue depuis le dossier App
        // Solution préconisée par SensioLabs
        // Utile dans le cas d'une application unique
        //return $this->render('default/hello.html.twig');


        // Vue depuis la vue dans le bundle
        // Utile dans le cas où l'on souhaite partager son Bundle
        return $this->render('AppBundle:default:hello.html.twig',
            [ 'name' => "Sylvia" ]
        );
    }


    /**
     * @Route(
     *     "/hello/all",
     *     name="Hello_All_Json_Web_Default",
     *     defaults={"format": "json"}
     * )
     * @Route(
     *     "/{format}/hello/all",
     *     name="Hello_All_Json_Web",
     *     requirements={
     *         "format": "|json|web"
     *     }
     * )
     */
    // needs use Symfony\Component\HttpFoundation\JsonResponse;
    public function Hello_All_Json_WebAction(Request $request, $format)
    {
        $output = array ('Sylvia', 'Fabrice', 'Nicolas');

        // Appel au service test
        $this->get('ServiceTest');

        // Appel à la methode test
        $this->get('ServiceTest')->test('parametre 1', 'parametre 2');


        switch ( $format){
            case "json":

                return new JsonResponse(array('output' => $output));

                break;
            case "web":
            default:

                // Vue depuis la vue dans le bundle
                // Utile dans le cas où l'on souhaite partager son Bundle
                return $this->render('AppBundle:default:Hello_All_Json_Web.html.twig',
                    [ 'output' => $output ]
                );

                break;
        }
    }
}
