<?php
namespace verbb\feedmepro;

use Craft;
use craft\base\Plugin;
use craft\db\Query;
use craft\events\PluginEvent;
use craft\helpers\UrlHelper;
use craft\services\Plugins;

use yii\base\Event;

class FeedMePro extends Plugin
{
    // Properties
    // =========================================================================

    public static $plugin;

    public $hasCpSettings = false;

    public $hasCpSection = false;


    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        self::$plugin = $this;

        // Show the CP Section if the free plugin isn't installed. We prompt users to install both
        // We can't use the `Craft::$app->plugins->getPlugin()` lookup, because if we install Pro first,
        // it'll be registered before the Free version, and will always report null...Bah!
        if (!$this->_pluginExists('feed-me')) {
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


    // Private Methods
    // =========================================================================

    private function _pluginExists($handle)
    {
        return (new Query())
            ->select(['id'])
            ->from(['{{%plugins}}'])
            ->where(['handle' => $handle])
            ->one();
    }

}
