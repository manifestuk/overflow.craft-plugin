<?php

namespace experience\overflow\assetbundles\overflow;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class OverflowAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = "@experience/overflow/assetbundles/overflow/dist";

        $this->depends = [CpAsset::class];

        $this->css = ['css/Overflow.css'];
        $this->js = ['js/Overflow.js'];

        parent::init();
    }
}
