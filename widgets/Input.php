<?php
/**
 * @link http://2amigos.us/
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group  LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace wheels\widgets;

/**
 * wheels\widgets\Input is the base class for all widgets that collect user inputs.
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @package wheels\widgets
 * @since 1.0
 */
class Input extends Widget
{
	/**
	 * @var \CModel the data model that this widget is associated with
	 */
	public $model;
	/**
	 * @var string the model attribute that this widget is associated with
	 */
	public $attribute;
	/**
	 * @var string the input name. This must be set if [[model]] and [[attribute]] are not set.
	 */
	public $name;
	/**
	 * @var string the input value.
	 */
	public $value;

	/**
	 * @return array the name and the ID of the input.
	 * @throws \CException
	 */
	protected function resolveNameID()
	{
		if($this->name!==null)
			$name=$this->name;
		elseif(isset($this->options['name']))
			$name=$this->options['name'];
		elseif($this->hasModel())
			$name=\CHtml::activeName($this->model,$this->attribute);
		else
			throw new \CException(Yii::t('wheels','{class} must specify "model" and "attribute" or "name" property values.',array('{class}'=>get_class($this))));

		if(($id=$this->getId(false))===null)
		{
			if(isset($this->options['id']))
				$id=$this->options['id'];
			else
				$id=CHtml::getIdByName($name);
		}

		return array($name,$id);
	}

	/**
	 * @return boolean whether this widget is associated with a data model.
	 */
	protected function hasModel()
	{
		return $this->model instanceof \CModel && $this->attribute!==null;
	}
}