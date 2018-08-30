<?php

namespace experience\overflow;

use craft\base\Plugin;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use experience\overflow\fields\Overflow as OverflowField;
use yii\base\Event;

class Overflow extends Plugin
{
    /** @var Overflow */
    public static $plugin;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->initializeStaticInstance();
        $this->registerField();
    }

    private function initializeStaticInstance()
    {
        self::$plugin = $this;
    }

    private function registerField()
    {
        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function (RegisterComponentTypesEvent $event) {
            $event->types[] = OverflowField::class;
        });
    }
}
