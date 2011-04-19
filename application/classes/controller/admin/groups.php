<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Groups extends Controller_Template_Admin
{
	/*group CRUD*/
	/*TODO: option to add a pre orded group to a dish*/

    public function action_add()
	{
		$this->_ajax = TRUE;
		$group = ORM::factory('group');
		$this->template->content = View::factory('admin/groups/add&edit')
			->set('type','add')
			->set('group',$group);
}
	public function action_edit($id,$hide=NULL)
	{
		$group = ORM::factory('group', $id);
		$type = 'edit';
		$this->_ajax = true;
		$this->template->content = View::factory('admin/groups/add&edit')
							   ->set('group',$group)
							   ->set('id',$id)
                                ->set('hide',$hide)
							   ->set('type',$type);

	}
    public function action_view($id,$hide=NULL)
	{
		$group = ORM::factory('group', $id);
		$type = 'edit';
		$this->_ajax = true;
		$this->template->content = View::factory('admin/groups/view')
							   ->set('group',$group)
							   ->set('id',$id)
                                ->set('hide',$hide)
							   ->set('type',$type);

	}
	public function action_create($id = NULL)
	{
            $group = ORM::factory('group', $id);
            $type = (isset($id)) ? 'edit' : 'add';
            $this->template->content = View::factory('admin/groups/add&edit')
                ->set('post', $_POST)
                ->set('group',$group)
                ->set('type',$type)
                ->set('id',$id)
                ->bind('errors', $errors);
            if ($_POST)
            {
                $group->values($_POST);

                if ($type!='edit'){
                    $group->user_id = (!$this->_checkSupadmin()) ? $_SESSION['auth_user_munch']->id  : 0 ;
                }
                try
                {
                    $group->save();
                    if(isset($_POST['dish_id']))
                    {
                        $group->remove('dishes');
                        foreach($_POST['dish_id'] as $dish)
                        {
                                $group->add('dishes',$dish);
                        }
                    }
                    
					die();
                }
                catch (ORM_Validation_Exception $e)
                {
                    $errors = $e->errors('models');
                }
            }
            $this->_ajax = TRUE;
        }
    public function action_delete($id)
	{
		$group = ORM::factory('group',$id);
        $group->remove('dishes');
        $group->remove('subs');
		$group->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}

	/*sub CRUD*/
    public function action_addsub($group_id)
	{
		$this->_ajax = TRUE;
		$group = ORM::factory('group',$group_id);
		$this->template->content = View::factory('admin/groups/add&edit_sub')
			->set('type','add')
			->set('group',$group);
	}
/*
	public function action_createsub($id = NULL)
	{
		$sub = ORM::factory('sub', $id);
		$type = (isset($id)) ? 'edit' : 'add';
		$dish_id = ($type == 'edit') ? $sub->group->dish_id : $_POST["dish_id"];
		$group_id = ($type == 'edit') ? $sub->group->id : $_POST["group_id"];
		$this->template->content = View::factory('admin/groups/add&edit_sub')
			->set('post', $_POST)
			->set('sub',$sub)
			->set('dish_id',$dish_id)
			->set('group_id',$group_id)
			->set('type',$type)
			->set('id',$id)
			->bind('errors', $errors);
			if ($_POST)
			{
					$sub->values($_POST);
				try
				{
							$has_sub = orm::factory('sub')->where('group_id','=',$group_id)->where('sub_id','=',$sub->sub_id)->find()->as_array();
							if(empty($has_sub->id))
								$sub->save();
					die();
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}
			}
			$this->_ajax = TRUE;
	}
 * */
	public function action_createsub($group_id)
	{
		$this->_ajax = TRUE;

		$group= ORM::factory('group', $group_id);
		$this->template->content = View::factory('admin/groups/add&edit_sub')
				   ->set('post', $_POST)
				   ->set('group',$group)
				   ->set('type','add')
				   ->bind('errors', $errors);
	   if ($_POST)
	   {
		   try
		   {
			   $sub_dish = ORM::factory('dish', $_POST['sub_id']);
			   if (!$group->has('subs',$sub_dish)) {
                   $group->add('subs',$sub_dish);
                   $sub_in_group = orm::factory('sub')->where('sub_id','=',$sub_dish->id)->and_where('group_id','=',$group->id)->find() ;
                   $sub_in_group->price=  ($_POST['price']>0) ? $_POST['price'] : 0;
                   $sub_in_group->save();
			   }
			   die();
		   }
		   catch (ORM_Validation_Exception $e)
		   {
			   $errors = $e->errors('models');
		   }
	   }
	   $this->_ajax = TRUE;
	}
/* 
public function action_deletesub($id)
=======
        $group= ORM::factory('group', $group_id);
        $this->template->content = View::factory('admin/groups/add&edit_sub')
                   ->set('post', $_POST)
                   ->set('group',$group)
                   ->set('type','add')
                   ->bind('errors', $errors);
               if ($_POST)
               {
                   try
                   {
                       $sub_dish = ORM::factory('dish', $_POST['sub_id']);
                       if (!$group->has('subs',$sub_dish)) {
                            $group->add('subs',$sub_dish);
                       }
                       die();
                   }
                   catch (ORM_Validation_Exception $e)
                   {
                       $errors = $e->errors('models');
                   }
               }

               $this->_ajax = TRUE;


}
*/
	public function action_removesub($sub_id,$group_id)
	{
		$sub_dish = ORM::factory('dish', $sub_id);
		$group= ORM::factory('group', $group_id);
		$group->remove('subs',$sub_dish);
        //$subgroup=ORM::factory('sub')->where('group_id','=',$group_id)->and_where('sub_id','=',$sub_id)->find();
        //$subgroup->delete();
		$this->request->redirect(Route::get('admin')->uri());
	}
}

