<?php

namespace craft\commerce\elements\actions;

use Craft;
use craft\base\ElementAction;

/**
 * Class Create Discount
 *
 * @property void   $triggerHtml
 * @property string $name
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2015, Pixel & Tonic, Inc.
 * @license   https://craftcommerce.com/license Craft Commerce License Agreement
 * @see       https://craftcommerce.com
 * @package   craft.plugins.commerce.elementactions
 * @since     1.0
 */
class CreateDiscount extends ElementAction
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return Craft::t('commerce', 'Create discount…');
    }

    /**
     * @inheritdoc
     */
    public function getTriggerHtml()
    {
        $js = <<<EOT
(function()
{
    var trigger = new Craft.ElementActionTrigger({
        handle: 'CreateDiscount',
        batch: true,
        activate: function(\$selectedItems)
        {
            Craft.redirectTo(Craft.getUrl('commerce/promotions/discounts/new', 'productIds='+Craft.elementIndex.getSelectedElementIds().join('|')));
        }
    });
})();
EOT;

        Craft::$app->getView()->registerJs($js);
    }
}
