<?php
namespace verbb\feedmepro\web\assets\feedmepro;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class FeedMeProAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    public function init()
    {
        $this->sourcePath = "@verbb/feedmepro/web/assets/feedmepro/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            'css/feed-me.css',
        ];

        parent::init();
    }
}
