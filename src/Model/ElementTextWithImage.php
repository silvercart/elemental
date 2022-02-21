<?php

namespace SilverCart\Elemental\Model;

use DNADesign\Elemental\Models\BaseElement;
use SilverCart\Forms\FormFields\TextCheckboxGroupField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;

/**
 * Element to show an image with a text.
 * 
 * @package SilverCart
 * @subpackage Elemental\Model
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @since 19.03.2019
 * @copyright 2019 pixeltricks GmbH
 * @license see license file in modules root directory
 */
class ElementTextWithImage extends BaseElement
{
    use \SilverCart\ORM\ExtensibleDataObject;
    /**
     * Icon class to use
     *
     * @var string
     */
    private static $icon = 'font-icon-image';
    /**
     * Table name.
     *
     * @var string
     */
    private static $table_name = 'SilverCart_ElementTextWithImage';
    /**
     * DB attributes.
     *
     * @var array
     */
    private static $db = [
        'SubTitle'       => 'Varchar(128)',
        'ShowSubTitle'   => 'Boolean',
        'Content'        => 'HTMLText',
        'Layout'         => 'Enum("ContentLeft,ContentRight","ContentLeft")',
        'BgColorContent' => 'Varchar(7)',
        'BgColorImage'   => 'Varchar(7)',
        'Ratio'          => 'Enum("1:1,2:1","1:1")',
    ];
    /**
     * Has one relations.
     *
     * @var array
     */
    private static $has_one = [
        'Image'     => Image::class,
        'Thumbnail' => Image::class,
    ];

    /**
     * Returns the field labels.
     * 
     * @param bool $includerelations Include relations?
     * 
     * @return array
     */
    public function fieldLabels($includerelations = true) : array
    {
        return $this->defaultFieldLabels($includerelations, [
            'LayoutContentLeft'  => _t(self::class . '.LayoutContentLeft', 'Text left, image right'),
            'LayoutContentRight' => _t(self::class . '.LayoutContentRight', 'Image left, text right'),
            'ShowSubTitleLabel'  => _t(self::class . '.ShowSubTitleLabel', 'Displayed'),
            'SubTitleLabel'      => _t(self::class . '.SubTitleLabel', 'Subtitle (displayed if checked)'),
        ]);
    }
    
    /**
     * Returns the CMS fields.
     *
     * @return FieldList
     */
    public function getCMSFields() : FieldList
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $layoutSource = [];
            $layoutEnum   = $this->dbObject('Layout');
            /* @var $enum \SilverStripe\ORM\FieldType\DBEnum */
            $layoutEnumValues = $layoutEnum->getEnum();
            foreach ($layoutEnumValues as $enumValue) {
                $layoutSource[$enumValue] = $this->fieldLabel("Layout{$enumValue}");
            }
            $fields->removeByName('ShowSubTitle');
            $fields->replaceField('SubTitle', TextCheckboxGroupField::create('SubTitle', $this->fieldLabel('SubTitleLabel')));
            $fields->dataFieldByName('BgColorContent')->setInputType('color')->addExtraClass('w-25 d-inline-block');
            $fields->dataFieldByName('BgColorImage')->setInputType('color')->addExtraClass('w-25 d-inline-block');
            $fields->dataFieldByName('Layout')->setSource($layoutSource);
            $fields->dataFieldByName('Thumbnail')->setDescription($this->fieldLabel('ThumbnailDesc'));
        });
        return parent::getCMSFields();
    }

    /**
     * Returns the summary as HTML text.
     * 
     * @return string
     */
    public function getSummary() : string
    {
        return DBField::create_field('HTMLText', $this->Content)->Summary(20);
    }

    /**
     * Provides the block schema.
     * 
     * @return array
     */
    protected function provideBlockSchema() : array
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }
    
    /**
     * Returns the style attribute for the image part.
     * 
     * @param bool $onlyAttributeValue Set this to true to return only the value
     * 
     * @return DBHTMLText
     */
    public function getStyleImage(bool $onlyAttributeValue = false) : DBHTMLText
    {
        $styles = [];
        if (!empty($this->BgColorImage)) {
            $styles['background-color'] = $this->BgColorImage;
        }
        return $this->getStyleAtt($styles, $onlyAttributeValue);
    }
    
    /**
     * Returns the style attribute for the text part.
     * 
     * @param bool $onlyAttributeValue Set this to true to return only the value
     * 
     * @return DBHTMLText
     */
    public function getStyleText(bool $onlyAttributeValue = false) : DBHTMLText
    {
        $styles = [];
        if (!empty($this->BgColorContent)) {
            $styles['background-color'] = $this->BgColorContent;
        }
        return $this->getStyleAtt($styles, $onlyAttributeValue);
    }
    
    /**
     * Returns the style attribute for the text part.
     * 
     * @param bool $onlyAttributeValue Set this to true to return only the value
     * 
     * @return DBHTMLText
     */
    public function getStyleSubTitle(bool $onlyAttributeValue = false) : DBHTMLText
    {
        $styles = [];
        if (!empty($this->BgColorImage)) {
            $styles['color'] = $this->BgColorImage;
        }
        return $this->getStyleAtt($styles, $onlyAttributeValue);
    }
    
    /**
     * Returns the style attribute for the text part.
     * 
     * @param array $styles             Key value pairs of styles to get
     * @param bool  $onlyAttributeValue Set this to true to return only the value
     * 
     * @return DBHTMLText
     */
    public function getStyleAtt(array $styles, bool $onlyAttributeValue = false) : DBHTMLText
    {
        $style = '';
        foreach ($styles as $styleName => $styleValue) {
            $style .= "{$styleName}:{$styleValue};";
        }
        if (!empty($style)
         && !$onlyAttributeValue
        ) {
            $style = " style=\"{$style}\"";
        }
        return DBHTMLText::create()->setValue($style);
    }

    /**
     * Returns the type.
     * 
     * @return string
     */
    public function getType() : string
    {
        return _t(self::class . '.BlockType', 'Text with image');
    }
    
    /**
     * Returns the preview image.
     * 
     * @return Image
     */
    public function PreviewImage() : Image
    {
        $previewImage = $this->Image();
        if ($this->Thumbnail()->exists()) {
            $previewImage = $this->Thumbnail();
        }
        return $previewImage;
    }
}
