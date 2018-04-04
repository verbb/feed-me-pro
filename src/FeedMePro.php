<?php
namespace verbb\feedmepro;

use Craft;
use craft\base\Plugin;

use yii\base\Event;

class FeedMePro extends Plugin
{
    // Properties
    // =========================================================================

    public static $plugin;


    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        self::$plugin = $this;
    }
}
