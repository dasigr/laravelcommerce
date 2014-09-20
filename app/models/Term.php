<?php

class Term extends BaseModel {
    
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'term';

    /**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('name');

    /**
     * Field validation rules.
     *
     * @var array
     */
    static $rules = array(
        'name' => 'required|unique:term,name'
    );

}