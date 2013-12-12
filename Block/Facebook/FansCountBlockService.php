<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Block\Facebook;

use Presta\CMSCoreBundle\Block\BaseBlockService;
use Presta\CMSSocialBundle\Model\FacebookManager;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class FansCountBlockService extends BaseBlockService
{
    /**
     * @var string
     */
    protected $template = 'PrestaCMSSocialBundle:Block/Facebook:block_fans_count.html.twig';

    /**
     * @var FacebookManager
     */
    private $facebookManager;

    /**
     * @param FacebookManager $facebookManager
     */
    public function setFacebookManager(FacebookManager $facebookManager)
    {
        $this->facebookManager = $facebookManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function getAdditionalFormSettings(FormMapper $formMapper, BlockInterface $block)
    {
        $formSettings = array(
            'facebook_page_id' => array(
                'facebook_page_id',
                'text',
                array(
                    'required' => true,
                    'label'    => $this->trans('form.label_facebook_page_id'),
                ),
            ),
        );

        return $formSettings + parent::getAdditionalFormSettings($formMapper, $block);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultSettings()
    {
        return array(
            'facebook_page_id' => null,
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getAdditionalViewParameters(BlockInterface $block)
    {
        if (null === $block->getSetting('facebook_page_id')) {
            return array();
        }

        $fanCounts = 0;

        try {
            $response = $this->facebookManager->getPageInfos($block->getSetting('facebook_page_id'));

            $fanCounts = $response->getFanCounts();
        } catch (\RuntimeException $e) {

        }

        return array('fans_count' => $fanCounts);
    }
}
