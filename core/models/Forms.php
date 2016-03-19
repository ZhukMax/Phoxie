<?php
use Phalcon\Mvc\Model, Phalcon\Mvc\Model\Relation;

class Forms extends Model
{
	public $id;
	public $title;
	public $condition;
	
	public function initialize()
	{
        $this->setSource(DB_PREFIX."forms");

		/* Relationships */
		$this->hasMany("id", "Tabs", "form_id", array(
			"foreignKey" => array(
                "action" => Relation::ACTION_CASCADE
            )
        ));
	}
}