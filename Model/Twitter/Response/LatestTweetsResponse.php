<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Model\Twitter\Response;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class LatestTweetsResponse
{
    /**
     * @var array
     */
    private $latestTweets;

    /**
     * @param array $latestTweets
     */
    public function __construct(array $latestTweets)
    {
        $this->latestTweets = $latestTweets;
    }

    /**
     * @return array
     */
    public function getlatestTweets()
    {
        return $this->latestTweets;
    }
}
