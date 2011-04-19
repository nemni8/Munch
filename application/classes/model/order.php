<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Order extends ORM
{
    protected $_has_many = array(
        'ordersdishes' => array(
            'model' => 'ordersdish',
			'through' => 'orders_dishes',
            'foreign_key' => 'order_id',
        ),
    );
    protected $_belongs_to = array(
		'user' => array(),
	);
    
    /*public function action_add(){

            $order = ORM::factory('order');
            $order->user_id=$_SESSION['auth_user_munch']->id;
            $order->save();
    }

    public function action_edit($id,$type,$value)
    {

        $order = ORM::factory('order', $id);
        if ($type=='timestamp') {
        // updating the timestamp NEED TO COMPLETE
        }
        else {
        $order->$type=$value;
        }
        $order->save();


    }

    public function action_delete($id)
    {
        $order = ORM::factory('order',$id);
        $order->remove('dishes');
        $order->delete();
        $this->request->redirect(Route::get('admin')->uri());

    }*/


/*   public function add($alias, $far_keys, $data = array())
    {
        $columns = array($this->_has_many[$alias]['foreign_key'], $this->_has_many[$alias]['far_key']);
        $foreign_key = $this->pk();

        if ($far_keys instanceof ORM)
        {
            $far_keys = $far_keys->pk();
            $columns = ( ! empty($data)) ? array_merge($columns, array_keys($data)) : $columns;
        }

        $query = DB::insert($this->_has_many[$alias]['through'], $columns);

        foreach ( (array) $far_keys as $key)
        {
            $query->values(array_merge(array($foreign_key, $key), ( ! empty($data)) ? array_values($data) : array()));
        }

        $query->execute($this->_db);

        return $this;
    }
	*/
    public function get_dishes_in_order()
    {
        return DB::select('id','price','quantity')->from('orders_dishes')->where('order_id','=',$this->id)->as_object()->execute();
    }
    public function calculate_total() {
        $temp=$this->get_dishes_in_order();
        $price=0 ;
        foreach ($temp as $dish) {
            $price+=($dish->price)*($dish->quantity);
        }
        // NEED TO HANDLE DELIVERY FEE
        $this->totalprice=$price;
        $this->save();
    }
} 