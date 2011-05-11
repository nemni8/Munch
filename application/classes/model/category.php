<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Category extends ORM
{
	protected $_has_many = array(
		'ingredients' => array(
			'model' => 'ingredient',
			'through' => 'categories_ingredients'
		),
		'restaurants' => array(
			'model' => 'restaurant',
			'through' => 'categories_restaurants'
		),
         'dishes' => array(
			'model' => 'dish',
			'through' => 'categories_dishes',             
		),
		'sub_dishes' => array(
			'model' => 'subdish',
			'through' => 'dishes_categories_subdishes'
		),
	);

    public function rules()
        {
            return array(
                'name' => array(
                    array('not_empty'),
                    array('max_length', array(':value', 32)),
                    array(array($this, 'name_available'), array(':validation', ':field')),
                ),
            );
        }

	public function name_available(Validation $validation, $field)
		{
			if ($this->unique_key_exists($validation[$field], 'name'))
			{
				$validation->error($field, 'name_available', array($validation[$field]));
			}
		}

	public function unique_key_exists($value, $field = NULL)
	{
		if ($field === NULL)
		{
			// Automatically determine field by looking at the value
			$field = 'name';
		}

            return (bool) DB::select(array('COUNT("*")', 'total_count'))
                ->from($this->_table_name)
                ->where($field, '=', $value)
                ->where($this->_primary_key, '!=', $this->pk())
                ->execute($this->_db)
                ->get('total_count');
        }

	public function get_col()
	{
		return
				array(
						'name'          => array('col_name' => 'name','title' => 'Category Name', 'type' => 'text'),
						'description'   => array('col_name' => 'description','title' => 'Description', 'type' => 'text'),
				 )
		;
	}
    public function get_headers()
	{
		return
				array(
                  'name'          => array('col_name' => 'name','title' => 'Name', 'type' => 'text'),
				 )
		;
	}
	public function get_all_categories($model = NULL)
	{

        return ( ! empty($model)) ?
									DB::select()->from('categories')->where('model','=',$model)->as_object()->execute() :
									DB::select()->from('categories')->as_object()->execute();
	}
        public function get_all_categories_user_can_edit($id)
    {

        return DB::select()->from('categories')->where('user_id','=',$id)->as_object()->execute();
    }


} // End Category Model