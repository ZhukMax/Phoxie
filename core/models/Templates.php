<?php
use Phalcon\Mvc\Model, Phalcon\Mvc\Model\Relation;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;

class Templates extends Model
{
	public $id;
	public $title;
	public $path;
	
	public function initialize()
	{
        $this->setSource(DB_PREFIX."templates");
		
		/* Relationships */
		$this->hasMany('id', 'Pages', 'template_id', array(
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
		$this->validate(
			new PresenceOf(
				array(
					"field" => 'path',
					"message" => 'Path is required'
				)
			)
		);
		return $this->validationHasFailed() != true;
	}
}
