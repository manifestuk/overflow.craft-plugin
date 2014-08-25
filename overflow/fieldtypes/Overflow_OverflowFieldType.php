<?php namespace Craft;

class Overflow_OverflowFieldType extends PlainTextFieldType
{
    /**
     * Returns the field's name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('Overflow');
    }

    /**
     * Defines the available field settings.
     *
     * @return array
     */
    protected function defineSettings()
    {
        return array_merge(
            ['overflowLimit' => [AttributeType::Number, 'min' => 0]],
            parent::defineSettings()
        );
    }

    /**
     * Returns the field settings HTML.
     *
     * @return string|null
     */
    public function getSettingsHtml()
    {
        return craft()->templates->render('overflow/settings', [
            'settings' => $this->getSettings(),
        ]);
    }

    /**
     * Returns the field input HTML.
     *
     * @param string $name The field name.
     * @param mixed $value The current field value.
     *
     * @return string
     */
    public function getInputHtml($name, $value)
    {
        $id = craft()->templates->formatInputId($name);

        $this->includeInputCss();
        $this->includeInputJs($id);

        return craft()->templates->render('overflow/input', [
            'id'       => $id,
            'name'     => $name,
            'settings' => $this->getSettings(),
            'value'    => $value,
        ]);
    }

    /**
     * Adds the field input CSS.
     *
     * @return void
     */
    protected function includeInputCss()
    {
        craft()->templates->includeCssResource('overflow/css/overflow.css');
    }

    /**
     * Adds the field input JS.
     *
     * @param string $fieldId
     *
     * @return void
     */
    protected function includeInputJs($fieldId)
    {
        $jsId = craft()->templates->namespaceInputId($fieldId);
        $settings = $this->getSettings();
        $limit = $settings['overflowLimit'];

        if ( ! $limit = $settings['overflowLimit']) {
            return;
        }

        craft()->templates->includeJsResource(
            'overflow/js/jquery.overflow.js');

        craft()->templates->includeJs(
            "$('#{$jsId}').overflow({ limit: {$limit} });");
    }
}
