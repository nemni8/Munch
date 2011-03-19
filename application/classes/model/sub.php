<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Sub extends ORM
{
    protected $_belongs_to = array(
		'group' => array(),
	);

	public function get_all_subs_in_group($group_id)
    {
    	return DB::select()->from('subs')->where('group_id','=',$group_id)->as_object()->execute();
    }

} 