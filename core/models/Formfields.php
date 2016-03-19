<?php
use Phalcon\Mvc\Model, Phalcon\Mvc\Model\Relation;

class Formfiels extends Model
{
	public $id;
	public $xfield_id;
	public $tab_id;
	public $active;
	
	public function initialize()
	{
        $this->setSource(DB_PREFIX."formfiels");

		/* Relationships */
		$this->belongsTo("xfield_id", "Extrafields", "id", array(
			"foreignKey" => array(
				"message" => "No such a Extrafield."
			)
		));
		$this->belongsTo("tab_id", "Tabs", "id", array(
			"foreignKey" => array(
				"message" => "No such a Tab."
			)
		));
	}
}