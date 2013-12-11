<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Parser\Twitter;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class TweetParser
{
    /**
     * @param array $tweet
     *
     * @return string
     */
    public function parse(array $tweet)
    {
        if (!isset($tweet['retweeted_status'])) {
            return $tweet['text'];
        }

        // Retweet can be truncated so we have to rebuild retweet from the original tweet
        return sprintf(
            'RT @%s: %s',
            $tweet['retweeted_status']['user']['screen_name'],
            $tweet['retweeted_status']['text']
        );
    }
}
