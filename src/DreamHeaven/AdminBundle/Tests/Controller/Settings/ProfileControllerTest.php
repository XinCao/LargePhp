<?php

namespace DreamHeaven\ApiBundle\Tests\Controller;

use DreamHeaven\ApiBundle\Tests\Helper\PhotoHelper;
use DreamHeaven\AdminBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    public function setUp()
    {
//        $container = $this->client->getContainer();
//        $this->user = $container->get('fos_user.user_manager')->findUserBy(array('username' => 'test1'));
    }

    public function testUpdateAvatarByAnonymouseUser_Failure()
    {
        $client = $this->createClient();
        $postData = array('crop_coords[x]' => 20, 'crop_coords[y]' => 20, 'crop_coords[width]' => 200, 'crop_coords[height]' => 200, );
        $filename = __DIR__.'/../../Resources/test.jpg';
        $files = array(
            'picture' => array('name' => 'test.jpg', 'type' => 'image/jpeg',
            'tmp_name' => $filename, 'size' => filesize($filename), 'error' => 0)
        );
        $client->request('POST', "/admin/settings/profile/update_avatar", $postData, $files);
        $response = $client->getResponse();


    }
}
