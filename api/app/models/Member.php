<?php


class Member extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'members';
	
	protected $fillable = array('id', 'username', 'password', 'nickname', 'email', 'create_at', 'update_at');
	
    public $timestamps = true;
}
