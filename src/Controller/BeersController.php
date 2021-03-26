<?php
namespace App\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Beers;
/**
 * Beers controller.
 * @Route("/api", name="api_")
 */
class BeersController extends AbstractController
{
    /**
     * Lists all Beers.
     * @Rest\Get("/beers")
     *
     * @param Request $request
     * @return Response
     * @throws GuzzleException
     */
    public function index(Request $request)
    {
        $search = $request->get("search");
        $showAll = $request->get("show_all");
        $client = new Client();
        // Se asignan 6 registros para realizar una prueba rapida y se requieren todos eliminar la variable per_page
        $response = $client->request('GET', 'https://api.punkapi.com/v2/beers?per_page=6');
        $beers = json_decode($response->getBody());
        // Validamos si se esta realizando una busqueda y el api retorna un array
        if (isset($search) && is_array($beers)){
            $beers = array_filter($beers, function($item) use($search){
                if (isset($item->food_pairing)){
                    foreach ($item->food_pairing as $food){
                        // Buscamos en el array los campos que contengan el valor de busqueda
                        if (str_contains(strtolower($food), strtolower($search))) {
                            $item = $item->id;
                            return $item;
                        }
                    }
                }
                return false;
            });
        }
        $newBeers = [];
        $key = 0;
        // Creamos el nuevo array con los campos necesarios
        foreach ($beers as $beer){
            if (isset($beer->id)){
                $newBeers[$key] = new \stdclass;
                $newBeers[$key]->id = $beer->id;
                $newBeers[$key]->name = isset($beer->name) ? $beer->name : '';
                $newBeers[$key]->description = isset($beer->description) ? $beer->description : '';
                if (isset($showAll)){
                    $newBeers[$key]->tagline = isset($beer->tagline) ? $beer->description : '';
                    $newBeers[$key]->first_brewed = isset($beer->first_brewed) ? $beer->first_brewed : '';
                    $newBeers[$key]->image_url = isset($beer->image_url) ? $beer->image_url : '';
                }
                $key++;
            }
        }

        return $this->json($newBeers);
    }
}