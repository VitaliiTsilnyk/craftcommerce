<?php
namespace Craft;

require_once(__DIR__ . '/Market_BaseElementType.php');

class Market_OrderElementType extends Market_BaseElementType
{

	public function getName()
	{
		return Craft::t('Orders');
	}

	public function hasContent()
	{
		return true;
	}

	public function hasTitles()
	{
		return false;
	}

	public function hasStatuses()
	{
		return false;
	}

	public function getSources($context = NULL)
	{

		$sources = [
			'*' => [
				'label' => Craft::t('All orders'),
			]
		];

		$sources[] = ['heading' => "Order Types"];

		foreach (craft()->market_orderType->getAll() as $orderType) {
			$key = 'orderType:' . $orderType->id;

			$sources[$key] = [
				'label'    => $orderType->name,
				'criteria' => ['typeId' => $orderType->id]
			];
		}

		$sources[] = ['heading' => "Order Statuses"];

		foreach (craft()->market_orderStatus->getAll() as $status){
			$key = 'orderStatus:' . $status->id;
			$sources[$key] = [
				'label'    => ucwords($status->name),
				'criteria' => ['orderStatus' => $status->id]
			];
		}
		return $sources;

	}

	public function defineTableAttributes($source = NULL)
	{
		return [
			'number'     => Craft::t('Number'),
			'orderStatus'=> Craft::t('Status'),
			'finalPrice' => Craft::t('Total Payable')
		];
	}

	public function defineSearchableAttributes()
	{
		return ['number'];
	}

	public function getTableAttributeHtml(BaseElementModel $element, $attribute)
	{

		if ($attribute == 'orderStatus') {
			return $element->orderStatus->printName();
		}

		return parent::getTableAttributeHtml($element, $attribute);
	}

	public function defineSortableAttributes()
	{
		return [
			'number'     => Craft::t('Number'),
			'finalPrice' => Craft::t('Total Payable'),
		];
	}


	public function defineCriteriaAttributes()
	{
		return [
			'typeId' => AttributeType::Mixed,
			'type'   => AttributeType::Mixed,
			'number' => AttributeType::Mixed,
			'status'  => AttributeType::Mixed,
			'statusId'  => AttributeType::Mixed
		];
	}


	public function modifyElementsQuery(DbCommand $query, ElementCriteriaModel $criteria)
	{
		$query
			->addSelect("orders.id, orders.typeId, orders.number, orders.finalPrice", "orders.statusId")
			->join('market_orders orders', 'orders.id = elements.id')
			->join('market_ordertypes ordertypes', 'ordertypes.id = orders.typeId');

		if ($criteria->type) {
			if ($criteria->type instanceof Market_OrderTypeModel) {
				$criteria->typeId = $criteria->type->id;
				$criteria->type   = NULL;
			} else {
				$query->andWhere(DbHelper::parseParam('ordertypes.handle', $criteria->type, $query->params));
			}
		}

		if ($criteria->typeId) {
			$query->andWhere(DbHelper::parseParam('orders.typeId', $criteria->typeId, $query->params));
		}

		if ($criteria->number) {
			$query->andWhere(DbHelper::parseParam('orders.number', $criteria->number, $query->params));
		}

		if ($criteria->status) {
			if ($criteria->status instanceof Market_OrderStatusModel) {
				$criteria->statusId = $criteria->status->id;
				$criteria->status   = NULL;
			}else{
				$query->andWhere(DbHelper::parseParam('orders.statusId', $criteria->status, $query->params));
			}
		}

		if ($criteria->statusId){
			$query->andWhere(DbHelper::parseParam('orders.statusId', $criteria->statusId, $query->params));
		}
	}


	public function populateElementModel($row)
	{
		return Market_OrderModel::populateModel($row);
	}

} 