<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Groups extends Controller_Template_Admin
{
	/*group CRUD*/
	/*TODO: option to add a pre orded group to a dish*/

    public function action_add($dish_id)
	{
		$this->_ajax = TRUE;
		$dish = ORM::factory('dish',$dish_id);
		$this->template->content = View::factory('admin/groups/add&edit')
			->set('type','add')
			->set('dish_id',$dish_id)
			->set('dish',$dish);
}
	public function action_edit($id =NULL)
	{
		$group = ORM::factory('group', $id);
		$type = 'edit';
        $_SESSION['group_id']=$id;
		$this->_ajax = true;
		$this->template->content = View::factory('admin/groups/add&edit')
							   ->set('group',$group)
							   ->set('dish_id',$_SESSION['dish_id'])
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
                    if (($type=='add') ) {//OR $_SESSION['dish_id']) {
                        if(isset($_POST['dish_id']))
                            $group->add('dishes',$_POST['dish_id']);
                    }
                    else
                    {
                        if(isset($_POST['dish_id']))
                        {
                            $group->remove('dishes');
                            foreach($_POST['dish_id'] as $dish)
                            {
                                    $group->add('dishes',$dish);
                            }
                        }
                    }
                    $_SESSION['dish_id']=NULL;
                    $_SESSION['group_id']=NULL;
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
		$group->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}

	/*sub CRUD*/

    public function action_addsub($group_id)
	{
		$this->_ajax = TRUE;
        //$dish_id=$_POST["dish_id"];
		//$group = ORM::factory('group',$group_id);
		$this->template->content = View::factory('admin/groups/add&edit_sub')
			->set('type','add')
			->set('group_id',$group_id)
			->set('dish_id',$_SESSION['dish_id']);
}
	public function action_editsub($id)//,$group_id,$dish_id)
	{
		$sub = ORM::factory('sub', $id);
        $dish_id=$_SESSION['dish_id'];
        $group_id=$_SESSION['group_id'];
		$type = 'edit';
		$this->_ajax = true;
		$this->template->content = View::factory('admin/groups/add&edit_sub')
									   ->set('sub',$sub)
									   ->set('dish_id',$dish_id)
									   ->set('group_id',$group_id)
									   ->set('id',$id)
										->set('type',$type);

        }
	public function action_createsub($id = NULL)
	{
            $sub = ORM::factory('sub', $id);
            $type = (isset($id)) ? 'edit' : 'add';
			$dish_id = ($type == 'edit') ? $_SESSION["dish_id"]:$_SESSION["dish_id"] ;
			$group_id =($type == 'edit') ? $sub->group->id : $_POST["group_id"];
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

