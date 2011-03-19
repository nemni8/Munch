<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Ingredient extends ORM
{
	protected $_has_many = array(
		'categories' => array(
			'model' => 'category',
			'through' => 'categories_ingredients'
		),
        'dishes' => array(
			'model' => 'dish',
			'through' => 'dishes_ingredients'
		)
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
						'name'          => array('col_name' => 'name','title' => 'Ingredient Name', 'type' => 'text'),
						'description'   => array('col_name' => 'description','title' => 'Ingredient Description', 'type' => 'text'),
				 )
		;
	}
	public function get_all_ingredients()
	{
		return DB::select()->from('ingredients')->as_object()->execute();
	}
public function get_all_ingredients_visible_for_user($id)
    {
    return DB::select()->from('ingredients')->where('user_id','=',$id)->or_where( 'user_id','=',0)->as_object()->execute();
    }

} // End Ingredient Model