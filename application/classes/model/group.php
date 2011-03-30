<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Group extends ORM
{
   //protected $_belongs_to = array(
	//	'dish' => array(),
	//);
	protected $_has_many = array(
		'subs' => array(
         'model' => 'dish',
			'through' => 'subs'  
        ),
        'dishes' => array(
			'model' => 'dish',
			'through' => 'dishes_groups'
		),
	);
	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('min_length', array(':value', 3)),
                array('max_length', array(':value', 32)),

			),
        );
    }
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
		
		$result=NULL;
        if(isset($user_id))
		{			
			$user = ORM::factory('user',$user_id);
			if( ! $user->has('roles',3))
			{
				$result  = DB::select('groups.*')->
						from('groups')->
						where('user_id','=',$user_id)->
						as_object()->execute();
			}
			else 
			{
				$result = DB::select()->from('groups')->as_object()->execute();
			}	
			
		}

		return $result;
	}
	public function get_all_groups_in_dish($id)
   {
		//return DB::select()->from('groups')->where('dish_id','=',$id)->as_object()->execute();
       $dish=ORM::factory('dish',$id);
       return $dish->groups->find_all();
   }
} 