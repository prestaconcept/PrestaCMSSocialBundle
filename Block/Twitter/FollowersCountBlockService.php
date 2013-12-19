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
    /**
     * @var string
     */
    protected $template = 'PrestaCMSSocialBundle:Block/Twitter:block_followers_count.html.twig';

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
            'title'            => array(
                'title',
                'text',
                array(
                    'required' => false,
                    'label'    => $this->trans('form.label_title')
                )
            ),
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
        if (null === $block->getSetting('twitter_username')) {
            return array();
        }

        $viewParameters = array();

        try {
            $viewParameters['followers_count'] = $this->twitterManager->getUserInfo(
                $block->getSetting('twitter_username')
            )->getFollowersCount();
        } catch (\RuntimeException $e) {

        }

        return $viewParameters;
    }

    /**
     * @return array
     */
    public function getDefaultSettings()
    {
        return array(
            'twitter_username' => null,
            'title'            => $this->trans('presta_cms_social.block.twitter.followers_count.title'),
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function trans($id, array $parameters = array())
    {
        return $this->translator->trans($id, $parameters, 'PrestaCMSSocialBundle');
    }
}
