<?php

/**
 * Represent model as array needed to create CMenu.
 * Usage:
 * 	'SAsCMenuArrayBehavior'=>array(
 * 		'class'=>'ext.behaviors.SAsCMenuArrayBehavior',
 * 		'labelAttr'=>'name',
 * 		'urlExpression'=>'array("/store/category", "id"=>$model->id)',
 * TODO: Cache queries
 * 	)
 */
class SAsCMenuArrayBehavior extends CActiveRecordBehavior
{

	/**
	 * @var string Owner attribute to be placed in `label` key
	 */
	public $labelAttr;

	/**
	 * @var string Expression will be evaluated to create url.
	 * Example: 'urlExpression'=>'array("/store/category", "id"=>$model->id)',
	 */
	public $urlExpression;

	public function asCMenuArray()
	{
		return $this->walkArray($this->owner);
	}

	/**
	 * Recursively build menu array
	 * @param $model CActiveRecord model with NestedSet behavior
	 * @return array
	 */
	protected function walkArray($model)
	{
		$data = array(
			'label'=>$model->{$this->labelAttr},
			'url'=>$this->evaluateUrlExpression($this->urlExpression, array('model'=>$model))
		);

		// TODO: Cache result
		$children = $model->children()->findAll();
		if(!empty($children))
		{
			foreach($children as $c)
				$data['items'][] = $this->walkArray($c);
		}

		return $data;
	}

	/**
	 * @param $expression
	 * @param array $data
	 * @return mixed
	 */
	public function evaluateUrlExpression($expression,$data=array())
	{
		extract($data);
		return eval('return '.$expression.';');
	}
}
