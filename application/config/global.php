<?php
return
		( array
				(
					/*kosher level array*/
					'kosher_level' => array
					(
						'not kosher',
						'kosher',
						'mehadrin kosher',
						'badatz kosher'


					),
                    'not_kosher_index' =>0,
					'kosher_index' =>1,
					'mehadrin_index' =>2,
					'badatz_index' =>3,

					/*restaurant meat dairy array*/
					'meat_dairy' => array
					(
						'',
						'meat',
						'dairy',
						'parve'
					),
					'meat_index' =>1,
					'dairy_index' =>2,
					'parve_index' =>3,

					/*dish meat dairy array*/
					'mdv' => array
					(
						'',
						'meat',
						'dairy',
                        'veggy',
						'parve',
					),
					'meat_index' =>1,
					'dairy_index' =>2,
                    'veggy_index' =>2,
					'parve_index' =>4,

					/*payment method array*/
					'payment_method' => array
					(
						'',
						'creditcard',
						'cash',
					),
					'creditcard_index' =>1,
					'cash_index' =>2,
                    /*information delivery  method array*/
					'info_method' => array
					(
						'',
						'email',
						'fax',
                        'sms'
					),
					'email_index' =>1,
					'fax_index' =>2,
            		'sms_index' =>3,

                    /*activaction  array*/
                    'active' => array
					(
						'not active',
						'active',

					),
					'not_index' =>0,
					'active_index' =>1,


                    /*basic or optional ingredient  array*/
                    'basic_optional' => array
					(
						'Basic',
						'Optional',
					),
					'basic_index' =>0,
					'optional_index' =>1,
            
					/*categories models array*/
					'categories_models' => array
					(
						'ingredient' =>'ingredient',
						'restaurant' =>'restaurant',
                        'dish' =>'dish'
					)

				)


		);
