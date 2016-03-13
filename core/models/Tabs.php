<?php
namespace Phoxie\Pages\Models

use Phalcon\Mvc\Model, Phalcon\Mvc\Model\Relation;

class Tabs extends Model
{
	public $id;
	public $title;
	public $caption;
	public $form;
	
	public function initialize()
	{
        $this->setSource(DB_PREFIX."tabs");

		/* Relationships */
		$this->hasMany('id', 'Phoxie\Pages\Models\Formfiels', 'tab_id', array(
			'foreignKey' => array(
                'action' => Relation::ACTION_CASCADE
            )
        ));
		$this->belongsTo("form", "Phoxie\Pages\Models\Forms", "id", array(
			"foreignKey" => array(
				"message" => "No such a form."
			)
		));
	}
}