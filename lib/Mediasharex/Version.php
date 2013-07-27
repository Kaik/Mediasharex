<?php
/**
 * Mediasharex version information and other metadata.
 */
class Mediasharex_Version extends Zikula_AbstractVersion
{
    /**
     * Provides an array of standard Zikula Extension metadata.
     * 
     * @return array Zikula Extension metadata.
     */
    public function getMetaData()
    {
        return array(
            'displayname'   => $this->__('Mediasharex'),
            'description'   => $this->__('Mediasharex module'),

            'url'           => $this->__('gallery'),

            'version'       => '5.0.0',
            'core_min' => '1.3.5', // Fixed to 1.3.x range
            'core_max' => '1.3.99', // Fixed to 1.3.x range

            'capabilities'  => array(
               HookUtil::SUBSCRIBER_CAPABLE => array('enabled' => true)
            ),

            'securityschema'=> array(
                'Mediasharex::'                 => '::',
                'Mediasharex::view'             => '::',
                'Mediasharex::item'             => 'DynamicUserData PropertyName::DynamicUserData PropertyID',
                'Mediasharex:Members:online'    => '::'
            ),
        );
    }
    /**
     * Define the hook bundles supported by this module.
     *
     * @return void
     */
    protected function setupHookBundles()
    {
        // Subscriber bundles
        $bundle = new Zikula_HookManager_SubscriberBundle($this->name, 'subscriber.mediasharex.ui_hooks.album', 'ui_hooks', $this->__('Album modify'));
        $bundle->addEvent('form_edit',    'mediasharex.ui_hooks.album.form_edit');
        $this->registerHookSubscriberBundle($bundle);

    }
}