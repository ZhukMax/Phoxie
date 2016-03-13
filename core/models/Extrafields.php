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

class Extrafields extends Model
{
	public $id;
	public $caption;
	public $title;
	public $type;
	public $properties;
	
	public function initialize()
	{
        $this->setSource(DB_PREFIX."xfields");
		$this->useDynamicUpdate(true);

		/* Relationships */
		$this->hasMany('id', 'Phoxie\Pages\Models\Extradata', 'xfield_id', array(
			'foreignKey' => array(
                'action' => Relation::ACTION_CASCADE
            )
        ));
		$this->hasMany('id', 'Phoxie\Pages\Models\Formfiels', 'xfield_id', array(
			'foreignKey' => array(
                'action' => Relation::ACTION_CASCADE
            )
        ));
		$this->belongsTo("type", "Phoxie\Pages\Models\Extratypes", "id", array(
			"foreignKey" => array(
				"message" => "No such a Extrafield's type."
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