<?php

return array(
    'username' => array(
        'not_empty' => 'You must provide a username.',
        'min_length' => 'The username must be at least :param2 characters long.',
        'max_length' => 'The username must be less than :param2 characters long.',
        'regex' => 'please use only numbers and digits ',
        'username_available'    => 'The username already exists',
    ),
    'password' => array(
       'not_empty' => 'Password cannot be empty',
    ),
     'password_confirm' => array(
        'matches'=> 'Password does not match!?!'
    ),

    'email' =>  array(
        'not_empty' => 'Please enter an email address',
        'min_length' => 'The username must be at least :param2 characters long.',
        'max_length' => 'The username must be less than :param2 characters long.',
        'email' =>'Not a valid email address',
        'email_available'    => 'The email address already exists',
            ),

		);
 
