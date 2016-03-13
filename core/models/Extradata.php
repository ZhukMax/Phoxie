<?php
namespace Phoxie\Pages\Models

use Phalcon\Mvc\Model, Phalcon\Mvc\Model\Relation;
use Phalcon\Mvc\Model\Validator\PresenceOf;
Model::setup(
    array(
        'notNullValidations'  => false
    )
);

class Extradata extends Model
{
	public $id;
	public $xfield_id;
	public $page_id;
	public $data;
	
	public function initialize()
	{
        $this->setSource(DB_PREFIX."xfields_data");
		$this->useDynamicUpdate(true);
		$this->skipAttributesOnUpdate(
            array(
				'xfield_id',
				'page_id'
            )
        );

		/* Relationships */
		$this->belongsTo("xfield_id", "Phoxie\Pages\Models\Extrafields", "id", array(
			"foreignKey" => array(
				"message" => "No such a Extrafield."
			)
		));
		$this->belongsTo("page_id", "Phoxie\Pages\Models\Pages", "id", array(
			"foreignKey" => array(
				"message" => "No such a Page."
			)
		));
	}
	public function validation()
    {
		$this->validate(
			new PresenceOf(
				array(
					"field" => 'xfield_id',
					"message" => 'Extrafield is required'
				)
			)
		);
		$this->validate(
			new PresenceOf(
				array(
					"field" => 'page_id',
					"message" => 'Extrafield is required'
				)
			)
		);
		return $this->validationHasFailed() != true;
	}
}