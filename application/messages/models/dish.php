<?php

return array(
    'name' => array(
        'not_empty' => 'You must provide a name.',
        'max_length' => 'The  name  must be less than :param2 characters long.',
    ),
    'price' => array(
        'not_empty' => 'Set the price!',
        'decimal' =>'Please enter a valid price',
    ),
    'size' => array(
        'not_empty' =>'Please specify the size',
            ),
    'mdv' => array(
           'not_empty' =>'Please specify meat/dairy',
       ),
       'category_id' => array(
           'not_empty' =>'Please choose at least one category',
               ),

);