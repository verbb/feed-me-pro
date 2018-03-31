<?php
namespace verbb\feedme;

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
