<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Dishes extends Controller_Template_Admin
{
	/*dish CRUD*/
    public function action_add()
	{
		if( ! $this->_checkAdmin())
		{
			echo 'you can not access to this page';
			die();
		}
		$user = ORM::factory('user',$_SESSION['auth_user_munch']->id);
		$dish = ORM::factory('dish');
		$this->template->content = View::factory('admin/dishes/add&edit')
				->set('type','add')
				->set('dish',$dish)
				->set('user',$user)
				->set('is_sup',$this->_checkSupadmin())
				->set('arr_input',$dish->get_col());
	}
	public function action_edit($id)
	{
		$dish = ORM::factory('dish', $id);
		$user = ORM::factory('user',$_SESSION['auth_user_munch']->id);
		$rest = ORM::factory('restaurant', $dish->restaurant->id);
		// check if the current user have access
		if( ! ( ($this->_checkSupadmin()) || ($rest->user_id == $_SESSION['auth_user_munch']->id)))
		{
			echo 'you can not access to this page';
			die();
		}
			$this->template->content = View::factory('admin/dishes/add&edit')
					->set('dish',$dish)
					->set('id',$id)
					->set('type','edit')
					->set('user',$user)
					->set('is_sup',$this->_checkSupadmin())
					->set('rest_id',$dish->restaurant->id)
					->set('arr_input',$dish->get_col());
	}
	public function action_create($id = NULL)
	{
		$dish = ORM::factory('dish', $id);
		$user = ORM::factory('user',$_SESSION['auth_user_munch']->id);
		$type = (isset($id)) ? 'edit' : 'add';
		$this->template->content = View::factory('admin/dishes/add&edit')
				->set('post', $_POST)
				->set('dish',$dish)
				->set('id',$id)
				->set('type',$type)
				->set('user',$user)
				->set('is_sup',$this->_checkSupadmin())
				->set('rest_id',$dish->restaurant->id)
				->set('arr_input',$dish->get_col())
				->bind('errors', $errors);
		if ($_POST)
		{

			$dish->values($_POST);

			try
			{

                $dish->save();
				if(isset($_POST['category_id']))
				{
					$dish->remove('categories');
					/*add category*/
					foreach($_POST['category_id'] as $cat)
					{
							$dish->add('categories',$cat);
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

		//$this->response->body($this->template->content);
	}
    public function action_delete($id)
	{
		$dish = ORM::factory('dish',$id);
		$dish->remove('ingredients');
		$dish->remove('groups');
        $dish->remove('categories');
		$dish->remove('fathers');
		$dish->delete();
		$this->request->redirect(Route::get('admin')->uri());
	}

    /*dish ingredient CRUD*/
    public function action_addingredient($dish_id)
	{
		$this->_ajax = TRUE;
		$this->template->content = View::factory('admin/dishes/add&edit_dish_ingredient')
			->set('type','add')
			->set('dish_id',$dish_id);
	}
	public function action_editingredient($id)
	{
		$dishesingredient = ORM::factory('dishesingredient', $id);
		$type = 'edit';
		$this->_ajax = true;
		$this->template->content = View::factory('admin/dishes/add&edit_dish_ingredient')
									   ->set('dishesingredient',$dishesingredient)
										->set('type',$type)
									   ->set('id',$dishesingredient->id);
	}
	public function action_createingredient($id = NULL)
	{
            $dishesingredient = ORM::factory('dishesingredient', $id);
            $type = (isset($id)) ? 'edit' : 'add';
            $this->template->content = View::factory('admin/dishesingredients/add&edit')
                ->set('post', $_POST)
                ->set('dishesingredient',$dishesingredient)
                ->set('type',$type)
                ->set('id',$id)
                ->bind('errors', $errors);
            if ($_POST)
            {
					$dishesingredient->values($_POST);
                    if (!$dishesingredient->basic_optional)
                        $dishesingredient->price=0;
					if($type == 'add')
						//echo 'in the if';
						$dishesingredient->ingredient_id = orm::factory('ingredient')->get_id_by_name($_POST["auto_ingredient"]);
                try
                {
					$dish = ORM::factory('dish',$dishesingredient->dish_id);
					if(( ! $dish->has('ingredients', $dishesingredient->ingredient_id) AND $type == 'add' AND $dishesingredient->ingredient_id > 0) OR $type == 'edit')
                    	$dishesingredient->save();
					die();
                }
                catch (ORM_Validation_Exception $e)
                {
                    $errors = $e->errors('models');
                }
            }
            $this->_ajax = TRUE;
        }
    public function action_deleteingredient($id)
	{
		$dishesingredient = ORM::factory('dishesingredient',$id);
		$dishesingredient->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}
    
	public function action_addgroup($dish_id)
	{
		$this->_ajax = TRUE;
		$dish = ORM::factory('dish',$dish_id);
		$this->template->content = View::factory('admin/dishes/add&edit_group')
			->set('type','add')
			->set('dish',$dish);
    }
            public function action_creategroup($dish_id)
            {

            $dish = ORM::factory('dish',$dish_id);
            $this->template->content = View::factory('admin/dishes/add&edit_group')
                       ->set('post', $_POST)
                       ->set('dish',$dish)
                       ->set('type','add')
                       ->bind('errors', $errors);
                   if ($_POST)
                   {
                       try
                       {
                           $group = ORM::factory('group', $_POST['group_id']);
                           if (!$dish->has('groups',$group)) {
                                $dish->add('groups',$group);
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
    public function action_removegroup($group_id,$dish_id)
	{
        $this->_ajax = TRUE;
        //$group= ORM::factory('group', $group_id);
        $dish = ORM::factory('dish', $dish_id);
        $dish->remove('groups',$group_id);
		$this->request->redirect(Route::get('admin')->uri());

	}
}
