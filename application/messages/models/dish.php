<?php

return array(
    'name' => array(
        'not_empty' => 'You must provide a name.',
        'min_lengh' =>' The  name  must be at least :param2 characters long.',
        'max_length' => 'The  name  must be less than :param2 characters long.',
    ),
    /*'price' => array(
        'not_empty' => 'Set the price!',
        'decimal' =>'Please enter a valid price',
    ),
    'size' => array(
        'not_empty' =>'Please specify the size',
            ),*/
    'mdv' => array(
           'range' =>'Please specify meat or dairy',
       ),
    /*'category_id' => array(
            'not_empty' =>'Please choose at least one category',
       ),*/

);