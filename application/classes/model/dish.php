<?php defined('SYSPATH') or die('No direct access allowed.');
class Model_Dish extends ORM
{
	protected $_has_many = array(
		'ingredients' => array(
			'model' => 'ingredient',
			'through' => 'dishes_ingredients'
		),
        'groups' => array(
			'model' => 'group',
			'through' => 'dishes_groups'
		),
        'categories' => array(
			'model' => 'category',
			'through' => 'categories_dishes'
        ),
        'fathers' => array(
			'model' => 'group',
			'through' => 'subs',
            'foreign_key' => 'sub_id',
		),
	);
    protected $_belongs_to = array(
		'restaurant' => array(),
	);

public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('min_length', array(':value', 3)),
                array('max_length', array(':value', 32)),
                //array(array($this, 'name_available'), array(':validation', ':field')),
			),
            //'rest_id' => array('not_empty' => NULL),

            'mdv' => array(
                array('range',array(':value',1,6))
            ),
		);
	}

	public function get_col()
	{
		return
				array(
					'name'       => array('col_name' => 'name','title' => 'Dish Name', 'type' => 'text'),
					'price'			=> array('col_name' => 'price','title' => 'Price ', 'type' => 'numeric'),
					'size'			=> array('col_name' => 'size','title' => 'Size', 'type' => 'numeric'),
					'description'  => array('col_name' => 'description','title' => 'Description', 'type' => 'textarea'),
					
				 )
		;
	}
   public function get_headers()
	{
		return
				array(
						'name' => array('col_name' => 'name','title' => 'Dish Name', 'type' => 'text'),
				 )
		;
	}
	public function get_search_info()
	{
		return
				array(
						'name'            => array('col_name' => 'name','title' => ' Name', 'type' => 'text'),
						
				 )
		;
	}
	public function get_categories($id){
		$str = "";
		$arr = DB::select('categories.name')
				->from('categories_dishes')
				->join('dishes')->on('categories_dishes.dish_id','=','dishes.id')
				->join('categories')->on('categories_dishes.category_id','=','categories.id')
                ->where('categories_dishes.dish_id','=',$id)->as_object()->execute();
		foreach ($arr as $val){
			$str .= $val->name.', ';
		}
		return $str;
	}
    public function get_ingredients_in_order_dish($ordersdish_id)
    {
            if (isset($_SESSION['cart_array'])) {
                return $_SESSION['cart_array'][$ordersdish_id]['ingredients'];
            }
            return false;
    }
        public function is_ingredient_in_order_dish($ingredient_id,$ordersdish_id)
        {
            $ingredients=$this->get_ingredients_in_order_dish($ordersdish_id);
            foreach ($ingredients as $ingredient) {
                if  ($ingredient['ingredient_id']==$ingredient_id)
                    return TRUE;
            }
            return FALSE;
        }
        public function get_subs_in_order_dish($ordersdish_id)
        {
            if (isset($_SESSION['cart_array'])) {
                return $_SESSION['cart_array'][$ordersdish_id]['subs'];
            }
            return false;
        }
        public function is_sub_in_order_dish($sub_id,$ordersdish_id)
        {
            $subs=$this->get_subs_in_order_dish($ordersdish_id);
            foreach ($subs as $sub) {
                if  ($sub['sub_id']==$sub_id)
                    return TRUE;
            }
            return FALSE;
        }

	public function get_all_dishes($user_id = NULL)
	{
		
		if(isset($user_id))
		{			
			$user = ORM::factory('user',$user_id);
			if( ! $user->has('roles',3))
			{
				$result = DB::select('dishes.*',array('restaurants.name','rest_name'),array('categories.name','cat_name'))->
						from('dishes')->
						join('restaurants')->
						on('dishes.restaurant_id', '=', 'restaurants.id')->
						join('categories_dishes', 'LEFT')->
						on('dishes.id', '=', 'categories_dishes.dish_id')->
						join('categories', 'LEFT')->
						on('categories.id', '=', 'categories_dishes.category_id')->
						where('restaurants.user_id','=',$_SESSION['auth_user_munch']->id)->
						as_object()->execute();
				
			}
			else 
			{
				$result = DB::select('dishes.*',array('restaurants.name','rest_name'),array('categories.name','cat_name'))->
						from('dishes')->
						join('restaurants')->
						on('dishes.restaurant_id', '=', 'restaurants.id')->
						join('categories_dishes', 'LEFT')->
						on('dishes.id', '=', 'categories_dishes.dish_id')->
						join('categories', 'LEFT')->
						on('categories.id', '=', 'categories_dishes.category_id')->
						on('dishes.restaurant_id', '=', 'restaurants.id')->
						as_object()->execute();
			}	
			
		}
		else
		{
			$result = DB::select()->from('dishes')->as_object()->execute();
		}	
		return $result;
	}
public function get_all_dishes_visible_for_rest($id)
    {
    return DB::select()->from('dishes')->where('rest_id','=',$id)->as_object()->execute();
    }
	public function add_new($post)
	{
		$dish = ORM::factory('dish');
		$dish->name = $post['name'];
        $dish->price = $post['price'];
        $dish->mdv = $post['mdv'];
        $dish->size = $post['size'];
		$dish->description = $post['description'];

        $dish->save();
            if(isset($post['category_id']))
		    {
			foreach($post['category_id'] as $cat)
			{
					$dish->add('categories',$cat);
			}
		}


	}
	public function edit($post)
	{

		$this->name = $post['name'];
        $this->price = $post['price'];
        $this->size = $post['size'];
        $this->description = $post['description'];
        $this->mdv = $post['mdv'];
        $this->price = $post['price'];
        $this->save();

		if(isset($post['category_id']))
		{
			$this->remove('categories');
			/*add category*/
			foreach($post['category_id'] as $cat)
			{
					$this->add('categories',$cat);
			}
		}


	}
} // End Ingredient Model