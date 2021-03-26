<?php
// tests/Util/CalculatorTest.php
namespace App\Tests\Util;

use App\Controller\BeersController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Client;

class BeersControllerTest extends WebTestCase
{
    public function testShow()
    {
        $client = static::createClient();
        $client->request('GET', '/api/beers/1?search=Spicy');
        $request = $client->getRequest();
        $search = $request->get("search");
        $showAll = $request->get("show_all");
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $clientGuzzle = new Client();
        $request = $clientGuzzle->get('https://api.punkapi.com/v2/beers?per_page=6');
        $data = json_decode($request->getBody());
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertIsArray($data);
        $this->assertIsString($search);
        $this->assertNull($showAll);
        $this->assertObjectHasAttribute("id", $data[0]);
        $this->assertObjectHasAttribute("name", $data[0]);
        $this->assertObjectHasAttribute("description", $data[0]);
        $this->assertObjectHasAttribute("food_pairing", $data[0]);
        $this->assertStringContainsString('Spicy', $data[0]->food_pairing[0]);
    }
}