<?php
namespace Phoxie\Pages\Models

use Phalcon\Mvc\Model, Phalcon\Mvc\Model\Relation;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
Model::setup(
    array(
        'notNullValidations'  => false
    )
);

class Extratypes extends Model
{
	public $id;
	public $caption;
	public $title;
	public $properties;
	
	public function initialize()
	{
        $this->setSource(DB_PREFIX."xfields_types");
		$this->useDynamicUpdate(true);

		/* Relationships */
		$this->hasMany('id', 'Phoxie\Pages\Models\Extrafields', 'type', array(
			'foreignKey' => array(
                'action' => Relation::ACTION_CASCADE
            )
        ));
	}
	public function validation()
    {
		$this->validate(
            new Uniqueness(
                array(
                    "field"   => "title",
                    "message" => "Title must be unique"
                )
            )
        );
		$this->validate(
			new PresenceOf(
				array(
					"field" => 'title',
					"message" => 'Title is required'
				)
			)
		);
		return $this->validationHasFailed() != true;
	}
}