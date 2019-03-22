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
 * @since 19.03.2019
 * @copyright 2019 pixeltricks GmbH
 * @license see license file in modules root directory
 */
class ElementContentExtension extends DataExtension
{
    /**
     * DB attributes.
     *
     * @var array
     */
    private static $db = [
        'SubTitle'     => 'Varchar(128)',
        'ShowSubTitle' => 'Boolean',
        'ColumnCount'  => 'Int(2)',
    ];
    
    /**
     * Updates the CMS fields
     * 
     * @param FieldList $fields Fields to update
     * 
     * @return void
     * 
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 19.03.2019
     */
    public function updateCMSFields(FieldList $fields) : void
    {
        $fields->removeByName('ShowSubTitle');
        $fields->replaceField(
            'SubTitle',
            TextCheckboxGroupField::create('SubTitle', $this->owner->fieldLabel('SubTitleLabel'))
        );
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
                'ShowSubTitleLabel' => _t(self::class . '.ShowSubTitleLabel', 'Displayed'),
                'SubTitleLabel'     => _t(self::class . '.SubTitleLabel', 'Subtitle (displayed if checked)'),
            ]
        );
    }
}