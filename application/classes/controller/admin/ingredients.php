<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ingredients extends Controller_Template_Admin
{
    public function action_add(){

            if( ! $this->_checkAdmin())
            {
                echo 'you can not access to this page';
                die();
            }
            $admin_level = ($this->_checkSupadmin()) ? 1 : 0 ;
            $ingredient = ORM::factory('ingredient');
            $this->template->content = View::factory('admin/ingredients/add&edit')
                ->set('type','add')
                ->set('admin_level',$admin_level)
                ->set('ingredient',$ingredient)
                ->set('arr_input',$ingredient->get_col());
        }

        public function action_edit($id)
        {

            $ingredient = ORM::factory('ingredient', $id);
            $type = 'edit';
            // check if the current user have access
            if(!( ($this->_checkSupadmin()) || ($ingredient->user_id==$_SESSION['auth_user_munch']->id)))
            {
                echo 'you can not access to this page';
                die();
            }
            $admin_level = ($this->_checkSupadmin()) ? 1 : 0 ;
            $this->template->content = View::factory('admin/ingredients/add&edit')
                ->set('ingredient',$ingredient)
                ->set('type',$type)
                ->set('admin_level',$admin_level)
                ->set('id',$id)
                ->set('arr_input',$ingredient->get_col());
        }
        public function action_create($id = NULL)
        {
            $admin_level = ($this->_checkSupadmin()) ? 1 : 0 ;
            $ingredient = ORM::factory('ingredient', $id);
            $type = (isset($id)) ? 'edit' : 'add';
            $this->template->content = View::factory('admin/ingredients/add&edit')
                ->set('post', $_POST)
                ->set('ingredient',$ingredient)
                ->set('type',$type)
                ->set('admin_level',$admin_level)
                ->set('id',$id)
                ->set('arr_input',$ingredient->get_col())
                ->bind('errors', $errors);

            if ($_POST)
            {

                $ingredient->values($_POST);
                $ingredient->user_id = (!$admin_level) ? $_SESSION['auth_user_munch']->id  : 0 ;
                $this->approval_level=$admin_level;
		        if($admin_level)
			        $this->user_id =  0 ;


                try
                {
                    $ingredient->save();
                    if(isset($_POST['category_id']))
                    {
                        $ingredient->remove('categories');
                        foreach($_POST['category_id'] as $cat)
                        {
                                $ingredient->add('categories',$cat);
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
		$ingredient = ORM::factory('ingredient',$id);
        if (($ingredient->user_id==$_SESSION['auth_user_munch']->id) || ($this->_checkSupadmin())) {
		    $ingredient->remove('categories');
            $ingredient->remove('dishes');
		    $ingredient->delete();
            $this->request->redirect(Route::get('admin')->uri());
        }
        else{
            echo "you don't have permission to delete this ingredient" ;
            die();
        }


	}
}
	
