<?php

namespace craft\commerce\records;

use craft\db\ActiveRecord;

/**
 * Discount Product type record.
 *
 * @property int $id
 * @property int $discountId
 * @property int $productTypeId
 *
 * @author    Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @copyright Copyright (c) 2015, Pixel & Tonic, Inc.
 * @license   https://craftcommerce.com/license Craft Commerce License Agreement
 * @see       https://craftcommerce.com
 * @package   craft.plugins.commerce.records
 * @since     1.0
 */
class DiscountProductType extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%commerce_discount_producttypes}}';
    }
//
//    /**
//     * @return array
//     */
//    public function defineIndexes()
//    {
//        return [
//            ['columns' => ['discountId', 'productTypeId'], 'unique' => true],
//        ];
//    }
//
//    /**
//     * @return array
//     */
//    public function defineRelations()
//    {
//        return [
//            'discount' => [
//                static::BELONGS_TO,
//                'Discount',
//                'onDelete' => self::CASCADE,
//                'onUpdate' => self::CASCADE,
//                'required' => true
//            ],
//            'productType' => [
//                static::BELONGS_TO,
//                'ProductType',
//                'onDelete' => self::CASCADE,
//                'onUpdate' => self::CASCADE,
//                'required' => true
//            ],
//        ];
//    }
//
//    /**
//     * @return array
//     */
//    protected function defineAttributes()
//    {
//        return [
//            'discountId' => [AttributeType::Number, 'required' => true],
//            'productTypeId' => [AttributeType::Number, 'required' => true],
//        ];
//    }

}