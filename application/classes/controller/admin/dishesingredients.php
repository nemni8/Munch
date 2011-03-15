<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Dishesingredients extends Controller_Template_Admin
{
	public function action_add($dish_id,$ingredient_id){

            if( ! $this->_checkAdmin())
            {
                echo 'you can not access to this page';
                die();
            }

            $dishesingredient = ORM::factory('dishesingredient');
            $this->template->content = View::factory('admin/dishesingredients/add&edit')
                ->set('type','add')
                ->set('dishesingredient',$dishesingredient);
        }

        public function action_edit($id)
        {

            $dishesingredient = ORM::factory('dishesingredient', $id);
            $type = 'edit';
            // check if the current user have access
            if(! $this->_checkSupadmin())
            {
                echo 'you can not access to this page';
                die();
            }
            //$dishesingredient = ORM::factory('dishesingredient')->where('dish_id','=',$dish_id)->and_where('ingredient_id','=',$ingredient_id);
            $this->template->content = View::factory('admin/dishesingredients/add&edit')
										   ->set('dishesingredient',$dishesingredient)
                                           ->set('type',$type)
                                           ->set('id',$dishesingredient->id);


        }
        public function action_create($id = NULL)
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
                $dishesingredient->dish_id=$_SESSION['dish_id'];
                $dishesingredient->ingredient_id=$_SESSION['ingredient_id'];

                try
                {
                    
                    $dishesingredient->save();

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
		$dishesingredient = ORM::factory('dishesingredient',$id);
		$dishesingredient->delete();
		$this->request->redirect(Route::get('admin')->uri());

	}

    /*
    public function action_add($id = NULL)
	{

		//POST
		if ( ! empty($_POST))
		{
			// set dishesingredient to be new or old
			if ( ! empty($id))
			{
				$dishesingredient = ORM::factory('dishesingredient',$id);
				// check if the current user have access to change user details
				if(!$this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$dishesingredient->edit(1,3,1);
			}
			else
			{
				$dishesingredient = ORM::factory('dishesingredient');
				$dishesingredient->add_new(1,3,1);
			}
			// if user is new then add to table if old then update

			$this->request->redirect(Route::get('admin')->uri());

		}
		// NOT POST
		else
		{
			// IF user exist AND current user is trying to edit his profile THEN read all filed
			if ( ! empty($id))
				{
				$dishesingredient = ORM::factory('dishesingredient', $id);
				// check if the current user have access to change user details
				if(  ! $this->_checkSupadmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$this->template->content = View::factory('admin/dishesingredients/add&edit')
										   ->set('dishesingredient',$dishesingredient)
                                           ->set('type','edit')

                                           ->set('id',$id);

			}
			// if rest not exist
			else
			{
				if(  ! $this->_checkAdmin())
				{
					echo 'you can not access to this page';
					die();
				}
				$dishesingredient = ORM::factory('dishesingredient');
				$this->template->content = View::factory('admin/dishesingredients/add&edit')
										   ->set('type','add')

										   ->set('dishesingredient',$dishesingredient);

			}
		}
	}
     */
}
