<?php


class Member extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'members';
	
	protected $fillable = array('id', 'email');
	

}
