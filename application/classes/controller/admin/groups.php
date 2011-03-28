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


    public function action_removesub($sub_id,$group_id)
	{
		 $sub_dish = ORM::factory('dish', $sub_id);
        $group= ORM::factory('group', $group_id);
        $group->remove('subs',$sub_dish);
		$this->request->redirect(Route::get('admin')->uri());

	}
    
}

