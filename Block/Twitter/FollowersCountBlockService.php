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
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class FollowersCountBlockService extends BaseBlockService
{
    protected $template = 'PrestaCMSSocialBundle:Block:block_twitter_followers.html.twig';

    /**
     * @var TwitterManager
     */
    private $twitterManager;

    /**
     * @param TwitterManager $twitterManager
     */
    public function setTwitterManager(TwitterManager $twitterManager)
    {
        $this->twitterManager = $twitterManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function getAdditionalFormSettings(FormMapper $formMapper, BlockInterface $block)
    {
        $formSettings = array(
            'twitter_username' => array(
                'twitter_username',
                'text',
                array(
                    'required' => true,
                    'label'    => $this->trans('form.label_twitter_username'),
                )
            ),
        );

        return $formSettings + parent::getAdditionalFormSettings($formMapper, $block);
    }

    /**
     * {@inheritdoc}
     */
    protected function getAdditionalViewParameters(BlockInterface $block)
    {
        $viewParameters = array('follower_count' => 0);

        try {
            $viewParameters['follower_count'] = $this->twitterManager->countFollowers(
                $block->getSetting('twitter_username')
            );
        } catch (\RuntimeException $e) {
            $viewParameters['has_exception'] = true;
        }

        return $viewParameters;
    }
}
