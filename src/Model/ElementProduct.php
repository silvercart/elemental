<?php

namespace SilverCart\Elemental\Model;

use DNADesign\Elemental\Models\BaseElement;
use Moo\HasOneSelector\Form\Field as HasOneSelector;
use SilverCart\Model\Product\Product;
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
class ElementProduct extends BaseElement
{
    use \SilverCart\ORM\ExtensibleDataObject;
    /**
     * Determines whether the method self::getCMSFields() is called or not.
     *
     * @var bool
     */
    protected $getCMSFieldsIsCalled = false;
    /**
     * Icon class to use
     *
     * @var string
     */
    private static $icon = 'font-icon-p-cart';
    /**
     * Table name.
     *
     * @var string
     */
    private static $table_name = 'SilverCart_ElementProduct';
    /**
     * DB attributes.
     *
     * @var array
     */
    private static $db = [
        'Content'        => 'HTMLText',
        'Layout'         => 'Enum("ContentLeft,ContentRight","ContentLeft")',
        'BgColorContent' => 'Varchar(7)',
        'BgColorImage'   => 'Varchar(7)',
    ];
    /**
     * Has one relations.
     *
     * @var array
     */
    private static $has_one = [
        'Product' => Product::class,
        'Image'   => Image::class,
    ];
    /**
     * Casted attributes.
     *
     * @var array
     */
    private static $casting = [
        'DisplayContent' => 'Text',
    ];
    /**
     * @var bool
     */
    private static $inline_editable = false;

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
            'ImageDesc'          => _t(self::class . '.ImageDesc', 'Leave empty to use the product image.'),
        ]);
    }
    
    /**
     * Returns the CMS fields.
     *
     * @return FieldList
     */
    public function getCMSFields() : FieldList
    {
        $this->getCMSFieldsIsCalled = true;
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $layoutSource = [];
            $layoutEnum   = $this->dbObject('Layout');
            /* @var $enum \SilverStripe\ORM\FieldType\DBEnum */
            $layoutEnumValues = $layoutEnum->getEnum();
            foreach ($layoutEnumValues as $enumValue) {
                $layoutSource[$enumValue] = $this->fieldLabel("Layout{$enumValue}");
            }
            $fields->dataFieldByName('BgColorContent')->setInputType('color');
            $fields->dataFieldByName('BgColorImage')->setInputType('color');
            $fields->dataFieldByName('Layout')->setSource($layoutSource);
            $fields->dataFieldByName('Content')->setDescription($this->fieldLabel('ContentDesc'));
            if ($this->exists()) {
                $fields->dataFieldByName('Image')->setDescription($this->fieldLabel('ImageDesc'));
            }
            if (class_exists(HasOneSelector::class)) {
                $fields->replaceField('ProductID', HasOneSelector::create('Product', $this->fieldLabel('Product'), $this, Product::class)->setLeftTitle($this->fieldLabel('Product'))->removeAddable());
            }
        });
        return parent::getCMSFields();
    }
    
    /**
     * Returns the display content.
     * 
     * @return DBHTMLText
     */
    public function getDisplayContent() : DBHTMLText
    {
        $displayContent = $this->Content;
        if (empty($displayContent)) {
            $displayContent = $this->Product()->ShortDescription;
            if (empty($displayContent)) {
                $displayContent = $this->Product()->LongDescription;
            }
        }
        return DBHTMLText::create()->setValue($displayContent);
    }
    
    /**
     * Returns the display image.
     * 
     * @return Image|null
     */
    public function getDisplayImage() : ?Image
    {
        $displayImage = $this->Image();
        if (!$displayImage->exists()) {
            $displayImage = $this->Product()->getListImage();
        }
        return $displayImage;
    }
    
    /**
     * Returns the title.
     * 
     * @return string|null
     */
    public function getTitle() : ?string
    {
        $title = $this->getField('Title');
        if (empty($title)
         && !$this->getCMSFieldsIsCalled) {
            $title = $this->Product()->Title;
        }
        return $title;
    }
    
    /**
     * Returns whether to show the display title or not.
     * 
     * @return bool
     */
    public function getShowDisplayTitle() : bool
    {
        $show = $this->ShowTitle;
        if ($this->Product()->exists()) {
            $show = true;
        }
        return $show;
    }

    /**
     * Returns the summary as HTML text.
     * 
     * @return string
     */
    public function getSummary() : string
    {
        return DBField::create_field('HTMLText', $this->DisplayContent)->Summary(20);
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
}
