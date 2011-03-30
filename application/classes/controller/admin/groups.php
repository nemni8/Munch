<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Groups extends Controller_Template_Admin
{
	/*group CRUD*/
	/*TODO: option to add a pre orded group to a dish*/

    public function action_add($dish_id)
	{
		$this->_ajax = TRUE;
		$dish = ORM::factory('dish');
		$this->template->content = View::factory('admin/groups/add&edit')
			->set('type','add')
			->set('dish_id',$dish_id)
			->set('dish',$dish);
}
	public function action_edit($id)
	{
		$group = ORM::factory('group', $id);
		$type = 'edit';
		$this->_ajax = true;
		$this->template->content = View::factory('admin/groups/add&edit')
							   ->set('group',$group)
							   ->set('dish_id',$group->dish_id)
							   ->set('id',$id)
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
                try
                {
                    $group->save();
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
			->set('group_id',$group_id)
			->set('dish_id',$group->dish_id);
}
	public function action_editsub($id)
	{
		$sub = ORM::factory('sub', $id);
		$type = 'edit';
		$this->_ajax = true;
		$this->template->content = View::factory('admin/groups/add&edit_sub')
									   ->set('sub',$sub)
									   ->set('dish_id',$sub->group->dish_id)
									   ->set('group_id',$sub->group->id)
									   ->set('id',$id)
										->set('type',$type);

        }
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
    public function action_deletesub($id)
	{
		$sub = ORM::factory('sub', $id);
		$sub->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}
}

