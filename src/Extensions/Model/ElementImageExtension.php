<?php

namespace SilverCart\Elemental\Extensions\Model;

use Dynamic\FlexSlider\Model\SlideImage;
use Sheadawson\Linkable\Forms\LinkField;
use Sheadawson\Linkable\Models\Link;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

/**
 * Extension for the ElementContent block.
 * 
 * @package SilverCart
 * @subpackage Elemental\Extensions\Model
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @since 13.01.2022
 * @copyright 2022 pixeltricks GmbH
 * @license see license file in modules root directory
 * 
 * @property \Dynamic\Elements\Image\Elements\ElementImage $owner Owner
 */
class ElementImageExtension extends DataExtension
{
    /**
     * DB attributes.
     *
     * @var array
     */
    private static $db = [
        'Description' => 'Text',
    ];
    /**
     * Has one relations.
     * 
     * @var array
     */
    private static $has_one = [
        'SlideLink' => Link::class,
    ];
    /**
     * Is this element inline editable?
     * 
     * @var bool
     */
    private static $inline_editable = false;
    
    /**
     * Updates the CMS fields
     * 
     * @param FieldList $fields Fields to update
     * 
     * @return void
     */
    public function updateCMSFields(FieldList $fields) : void
    {
        $fields->removeByName('SlideLinkID');
        $fields->dataFieldByName('Description')->setValue($this->owner->Description);
        $fields->insertAfter(
            'Description',
            LinkField::create('SlideLinkID', $this->owner->fieldLabel('SlideLinkID'))
        );
    }
    
    /**
     * Updates the field labels
     * 
     * @param array &$labels Labels to update
     * 
     * @return void
     */
    public function updateFieldLabels(&$labels) : void
    {
        $labels['Description'] = _t(SlideImage::class . '.DESCRIPTION', 'Description');
        $labels['SlideLinkID'] = _t(SlideImage::class . '.PAGE_LINK', 'Call to action link');
    }
}