<?php

namespace SilverCart\Elemental\Extensions\Model;

use ReflectionClass;
use SilverStripe\ORM\DataExtension;

/**
 * Extension to overwrite the default template of a block element.
 * 
 * @package SilverCart
 * @subpackage Elemental\Extensions\Model
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @since 19.03.2019
 * @copyright 2019 pixeltricks GmbH
 * @license see license file in modules root directory
 */
class ElementTemplateExtension extends DataExtension
{
    /**
     * Updates the render templates.
     * 
     * @param array &$templates Templates to update
     * 
     * @return void
     * 
     * @author Sebastian Diel <sdiel@pixeltricks.de>
     * @since 19.03.2019
     */
    public function updateRenderTemplates(array &$templates) : void
    {
        $reflection = new ReflectionClass($this->owner);
        $reflection->getShortName();
        $template  = "SilverCart\\Elemental\\Model\\{$reflection->getShortName()}";
        $templates = array_merge(
                [
                    $template => [
                        "{$template}_ElementalArea",
                        "{$template}",
                        "{$template}_ElementalArea",
                        "{$template}",
                    ]
                ],
                $templates
        );
    }
}