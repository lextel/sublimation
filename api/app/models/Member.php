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


    /**
     * 获取用户头像 姓名 IP
     *
     * @param $ids array ID数组
     *
     * @return array
     */
    public function byIds($ids) {
        $ids = array_unique($ids);
        $ids[] = 0;
        $members = Member::whereRaw('id in (' . implode(',', $ids) . ')')
                           ->get(['id', 'avatar', 'nickname', 'ip'])
                           ->toArray();

        $data = [];
        foreach($members as $member) {
            $data[$member['id']] = $member;
        }

        return $data;
    }
}
