<?php

namespace AdminBundle\Tests\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $client = null;

    public function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->client = static::createClient();
        $this->client->followRedirects();

    }

    /**
     * @dataProvider urlProvider
     */
    public function testIndex($url)
    {
//        $client = self::createClient();
//        $client->request('GET', $url);
//        $this->assertTrue($client->getResponse()->isSuccessful());

        $client = $this->getClientAuthenticated(1);
        $crawler = $client->request('GET', $url);

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function urlProvider()
    {
        return array(
            array('/admin'),
            array('/admin/edit/1'),
        );
    }

    private function getClientAuthenticated($user_id)
    {
        $user = $this->em->getRepository(User::class)->find($user_id);

        $session = $this->client->getContainer()->get('session');
        // the firewall context defaults to the firewall name
        $firewallContext = 'main';

        $token = new UsernamePasswordToken($user, null, $firewallContext, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);

        return $this->client;
    }
}
