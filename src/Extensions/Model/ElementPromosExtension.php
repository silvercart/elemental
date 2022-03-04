<?php

namespace SilverCart\Elemental\Extensions\Model;

use SilverCart\Dev\Tools;
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
    const TEMPLATE_BIG_TILES   = 'bigtiles';
    const TEMPLATE_HIGHLIGHT   = 'highlight';
    const TEMPLATE_SMALL_TILES = 'smalltiles';
    /**
     * DB attributes.
     *
     * @var array
     */
    private static $db = [
        'Template' => 'Enum("smalltiles,highlight,bigtiles","smalltiles")',
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
        $i18nSource = [];
        foreach ($this->owner->dbObject('Template')->enumValues() as $value => $label) {
            $i18nSource[$value] = empty($label) ? '' : $this->owner->fieldLabel("Template_{$label}");
        }
        $fields->dataFieldByName('Template')
                ->setSource($i18nSource)
                ->setDescription($this->owner->fieldLabel('TemplateDesc'));
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
        $labels = array_merge(
            $labels,
            Tools::field_labels_for(self::class),
            [
                'Template'     => _t(self::class . '.Template', 'Template'),
                'TemplateDesc' => _t(self::class . '.TemplateDesc', 'Will display a different theme dependent on the chosen template.'),
                'Template_bigtiles' => _t(self::class . '.Template_bigtiles', 'Big tiles (recommended when using images for each promo item)'),
                'Template_highlight' => _t(self::class . '.Template_highlight', 'Highlight (recommended to display few promo items with a highlighted theme)'),
                'Template_smalltiles' => _t(self::class . '.Template_smalltiles', 'Small tiles (recommended when using icons for each promo item)'),
            ]
        );
    }
    
    /**
     * Returns whether to use the bigtiles template.
     * 
     * @return bool
     */
    public function UseTemplateBigTiles() : bool
    {
        return $this->owner->Template === self::TEMPLATE_BIG_TILES;
    }
    
    /**
     * Returns whether to use the highlight template.
     * 
     * @return bool
     */
    public function UseTemplateHighlight() : bool
    {
        return $this->owner->Template === self::TEMPLATE_HIGHLIGHT;
    }
    
    /**
     * Returns whether to use the smalltiles template.
     * 
     * @return bool
     */
    public function UseTemplateSmallTiles() : bool
    {
        return $this->owner->Template === self::TEMPLATE_SMALL_TILES;
    }
}