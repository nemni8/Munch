<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Group extends ORM
{
   protected $_belongs_to = array(
		'dish' => array(),
	);
	protected $_has_many = array(
		'subs' => array(),
	);
	
	public function get_headers()
	{
		return
				array(
						'name'          => array('col_name' => 'name','title' => 'Group Name', 'type' => 'text'),
						'rule'      => array('col_name' => 'rule','title' => 'Rule', 'type' => 'text'),
				 )
		;
	}
	
	public function get_all_groups($user_id = NULL)
	{
		
		if(isset($user_id))
		{			
			$user = ORM::factory('user',$user_id);
			if( ! $user->has('roles',3))
			{
				$result = $result = DB::select('groups.*')->
						from('groups')->
						join('dishes')->
						on('dishes.id', '=', 'groups.dish_id')->
						join('restaurants')->
						on('dishes.restaurant_id', '=', 'restaurants.id')->
						where('restaurants.user_id','=',$_SESSION['auth_user_munch']->id)->
						as_object()->execute();
			}
			else 
			{
				$result = DB::select()->from('groups')->as_object()->execute();
			}	
			
		}
		else
		{
			$result = DB::select()->from('groups')->as_object()->execute();
		}	
		return $result;
	}
	public function get_all_groups_in_dish($id)
   {
		return DB::select()->from('groups')->where('dish_id','=',$id)->as_object()->execute();
   }
} 