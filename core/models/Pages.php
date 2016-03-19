<?php
use Phalcon\Mvc\Model, Phalcon\Mvc\Model\Relation;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\PresenceOf;
Model::setup(
    array(
        'notNullValidations'  => false
    )
);

class Pages extends Model
{
	public $id;
	public $pagetitle;
	public $metatitle;
	public $keywords;
	public $description;
	public $content;
	public $alias;
	public $template_id;
	public $pubdate;
	public $editdate;
	public $parent;
	
	public function initialize()
	{
        $this->setSource(DB_PREFIX."pages");
		$this->useDynamicUpdate(true);

		/* Relationships */
		$this->hasMany('id', 'Extradata', 'page_id', array(
			'foreignKey' => array(
                'action' => Relation::ACTION_CASCADE
            )
        ));
		$this->belongsTo("template_id", "Templates", "id", array(
			"foreignKey" => array(
				"message" => "No such a template."
			)
		));

		$this->skipAttributesOnUpdate(
            array(
				'pubdate'
            )
        );
	}
	public function validation()
    {
		$this->validate(
            new Uniqueness(
                array(
                    "field"   => "alias",
                    "message" => "Alias must be unique"
                )
            )
        );
		$this->validate(
			new PresenceOf(
				array(
					"field" => 'pagetitle',
					"message" => 'Pagetitle is required'
				)
			)
		);
		$this->validate(
			new PresenceOf(
				array(
					"field" => 'alias',
					"message" => 'Alias is required'
				)
			)
		);
		return $this->validationHasFailed() != true;
	}
	public function beforeCreate()
    {
        $this->pubdate = time();
		$this->editdate = time();
    }
    public function beforeUpdate()
    {
        $this->editdate = time();
    }
}