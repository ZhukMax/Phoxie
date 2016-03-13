<?php
namespace Phoxie\Pages\Models

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
		$this->hasMany("id", "Phoxie\Pages\Models\Tabs", "form", array(
			"foreignKey" => array(
                "action" => Relation::ACTION_CASCADE
            )
        ));
	}
}