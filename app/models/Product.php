<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Kyle
 */
class Product extends Eloquent {

    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'product';

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
	protected $fillable = array('name', 'description');

    /**
     * Field validation rules.
     *
     * @var array
     */
    static $rules = array(
        'name' => 'required|unique:product,name'
    );

}
