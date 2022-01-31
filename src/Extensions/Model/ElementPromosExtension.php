<?php

namespace SilverCart\Elemental\Extensions\Model;

use SilverCart\Dev\Tools;
use SilverCart\Forms\FormFields\TextCheckboxGroupField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

/**
 * Extension for the ElementContent block.
 * 
 * @package SilverCart
 * @subpackage Elemental\Extensions\Model
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @since 31.01.2022
 * @copyright 2022 pixeltricks GmbH
 * @license see license file in modules root directory
 * 
 * @property \Dynamic\Elements\Promos\Elements\ElementPromos $owner Owner
 */
class ElementPromosExtension extends DataExtension
{
    /**
     * DB attributes.
     *
     * @var array
     */
    private static $db = [
        'UseAlternativeTemplate' => 'Boolean',
    ];
    
    /**
     * Updates the CMS fields
     * 
     * @param FieldList $fields Fields to update
     * 
     * @return void
     */
    public function updateCMSFields(FieldList $fields) : void
    {
        $fields->dataFieldByName('UseAlternativeTemplate')->setDescription($this->owner->fieldLabel('UseAlternativeTemplateDesc'));
    }
    
    /**
     * Updates the field labels
     * 
     * @param array &$labels Labels to update
     * 
     * @return void
     * 
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 19.03.2019
     */
    public function updateFieldLabels(&$labels) : void
    {
        $labels = array_merge(
            $labels,
            Tools::field_labels_for(self::class),
            [
                'UseAlternativeTemplate'     => _t(self::class . '.UseAlternativeTemplate', 'Use alternative template'),
                'UseAlternativeTemplateDesc' => _t(self::class . '.UseAlternativeTemplateDesc', 'If checked, the promo items will be rendered in an alternative, more prominent view. Recommended to highlight few promo items.'),
            ]
        );
    }
}