<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Block\Twitter;

use Presta\CMSCoreBundle\Block\BaseBlockService;
use Presta\CMSSocialBundle\Model\TwitterManager;
use Presta\CMSSocialBundle\Parser\Twitter\TweetParser;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class LatestTweetBlockService extends BaseBlockService
{
    /**
     * @var string
     */
    protected $template = 'PrestaCMSSocialBundle:Block/Twitter:block_latest_tweets.html.twig';

    /**
     * @var TwitterManager
     */
    private $twitterManager;

    /**
     * @var TweetParser
     */
    private $parser;

    /**
     * @param TwitterManager $twitterManager
     */
    public function setTwitterManager(TwitterManager $twitterManager)
    {
        $this->twitterManager = $twitterManager;
    }

    /**
     * @param TweetParser $parser
     */
    public function setTweetParser(TweetParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * {@inheritdoc}
     */
    protected function getFormSettings(FormMapper $formMapper, BlockInterface $block)
    {
        $formSettings = array(
            'title'            => array(
                'title',
                'text',
                array(
                    'required' => false,
                    'label' => $this->trans('form.label_title')
                )
            ),
            'twitter_username' => array(
                'twitter_username',
                'text',
                array(
                    'required' => true,
                    'label'    => $this->trans('form.label_twitter_username'),
                ),
            ),
            'limit'            => array(
                'limit',
                'text',
                array(
                    'required' => true,
                    'label'    => $this->trans('form.label_tweet_limit'),
                    'data'     => 10,
                ),
            ),
            'exclude_replies'  => array(
                'exclude_replies',
                'checkbox',
                array(
                    'required' => false,
                    'label'    => $this->trans('form.label_tweet_exclude_replies'),
                    'data'     => true,
                ),
            ),
            'include_retweets' => array(
                'include_retweets',
                'checkbox',
                array(
                    'required' => false,
                    'label'    => $this->trans('form.label_tweet_include_retweets'),
                    'data'     => true,
                ),
            ),
        );

        return $formSettings;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultSettings()
    {
        return array(
            'twitter_username' => null,
            'limit'            => 10,
            'exclude_replies'  => true,
            'include_retweets' => true,
            'title'            => $this->trans('block.title.presta_cms_social.block.twitter.latest_tweets'),
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getAdditionalViewParameters(BlockInterface $block)
    {
        if (null === $block->getSetting('twitter_username')) {
            return array();
        }

        $latestTweets = array();

        try {
            $response = $this->twitterManager->getLatestTweet(
                $block->getSetting('twitter_username'),
                $block->getSetting('limit'),
                $block->getSetting('exclude_replies'),
                $block->getSetting('include_retweets')
            );

            $latestTweets = $response->getlatestTweets();
        } catch (\RuntimeException $e) {

        }

        $tweets = array();

        foreach ($latestTweets as $tweet) {
            $tweets[] = $this->parser->parse($tweet);
        }

        return array(
            'tweets' => $tweets,
        );
    }
}
