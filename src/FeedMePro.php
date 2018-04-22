<?php
namespace verbb\feedmepro;

use Craft;
use craft\base\Plugin;
use craft\events\PluginEvent;
use craft\helpers\UrlHelper;
use craft\services\Plugins;

use yii\base\Event;

class FeedMePro extends Plugin
{
    // Properties
    // =========================================================================

    public $hasCpSettings = false;

    public $hasCpSection = false;


    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        // Show the CP Section if the free plugin isn't installed. We prompt users to install both
        if (!Craft::$app->plugins->getPlugin('feed-me')) {
            $this->hasCpSection = true;

            // Plugin Install event
            Event::on(Plugins::class, Plugins::EVENT_AFTER_INSTALL_PLUGIN, [$this, 'afterInstallPlugin']);
        }
    }

    public function afterInstallPlugin(PluginEvent $event)
    {
        if ($event->plugin === $this && Craft::$app->getRequest()->isCpRequest) {
            Craft::$app->controller->redirect(UrlHelper::cpUrl('feed-me-pro'))->send();
        }
    }

    public function getCpNavItem()
    {
        $navItem = parent::getCpNavItem();
        $navItem['label'] = 'Feed Me';

        return $navItem;
    }
}
