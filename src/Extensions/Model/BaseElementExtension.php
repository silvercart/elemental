<?php

namespace SilverCart\Elemental\Extensions\Model;

use Dynamic\Elements\CustomerService\Elements\ElementCustomerService;
use Dynamic\Elements\Features\Elements\ElementFeatures;
use Dynamic\Elements\Flexslider\Elements\ElementSlideshow;
use Dynamic\Elements\Image\Elements\ElementImage;
use Dynamic\Elements\Promos\Elements\ElementPromos;
use SilverStripe\ORM\DataExtension;

/**
 * Extension for DNADesign Elemental BaseElement.
 * 
 * @package SilverCart
 * @subpackage Elemental\Extensions\Model
 * @author Sebastian Diel <sdiel@pixeltricks.de>
 * @since 24.01.2022
 * @copyright 2022 pixeltricks GmbH
 * @license see license file in modules root directory
 * 
 * @property \DNADesign\Elemental\Models\BaseElement $owner Owner
 */
class BaseElementExtension extends DataExtension
{
    /**
     * Returns whether the current element uses an outer container for rendering.
     * 
     * @return bool
     */
    public function UseOuterContainer() : bool
    {
        $use = !in_array(get_class($this->owner), [
                    ElementCustomerService::class,
                    ElementFeatures::class,
                    ElementSlideshow::class,
                    ElementImage::class,
               ])
            && !(get_class($this->owner) === ElementPromos::class
             && $this->owner->UseAlternativeTemplate);
        $this->owner->extend('updateUseOuterContainer', $use);
        return (bool) $use;
    }
}