<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Model;

use Guzzle\Http\Client;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class TwitterManager
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $username
     *
     * @throws \RuntimeException
     *
     * @return int
     */
    public function getFollowersCount($username)
    {
        $parameters = array('screen_name' => $username);

        try {
            $response = $this->client->get('users/show.json?' . http_build_query($parameters))->send()->json();
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Unable to find the twitter user with username %s', $username));
        }

        return !isset($response['followers_count']) ? 0 : $response['followers_count'];
    }
}
