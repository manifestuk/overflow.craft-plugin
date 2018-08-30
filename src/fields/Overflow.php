<?php

namespace experience\overflow\fields;

use Craft;
use craft\base\ElementInterface;
use craft\fields\PlainText;
use experience\overflow\assetbundles\overflow\OverflowAsset;

class Overflow extends PlainText
{
    /** @var bool Should the character limit be enforced? */
    public $enforceLimit;

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('overflow', 'Overflow');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['enforceLimit'], 'boolean']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('overflow/_components/fields/settings', ['field' => $this]);
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        $this->registerInputHtmlAssets();
        $this->registerInputHtmlJs();

        return Craft::$app->getView()->renderTemplate('_components/fieldtypes/PlainText/input', [
            'id'    => Craft::$app->getView()->formatInputId($this->handle),
            'name'  => $this->handle,
            'value' => $value,
            'field' => $this,
        ]);
    }

    /**
     * Register the field asset bundle
     *
     * @throws \yii\base\InvalidConfigException
     */
    private function registerInputHtmlAssets()
    {
        Craft::$app->getView()->registerAssetBundle(OverflowAsset::class);
    }

    /**
     * Register the field initialisation JavaScript
     */
    private function registerInputHtmlJs()
    {
        $elementId = Craft::$app->getView()->namespaceInputId(Craft::$app->getView()->formatInputId($this->handle));
        $enforceLimit = $this->enforceLimit ? 'true' : 'false';

        Craft::$app->getView()->registerJs("$('#{$elementId}').overflow({enforceLimit: {$enforceLimit}});");
    }

    /**
     * @inheritdoc
     */
    public function getElementValidationRules(): array
    {
        $max = ($this->charLimit && $this->enforceLimit) ? $this->charLimit : null;

        return [['string', 'max' => $max]];
    }
}
