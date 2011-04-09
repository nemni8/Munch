<?php
return
		( array
				(
					/*kosher level array*/
					'kosher_level' => array
					(
						'Not Kosher',
						'Kosher',
						'Mehadrin Kosher',
						'Badatz Kosher'


					),
                    'not_kosher_index' =>0,
					'kosher_index' =>1,
					'mehadrin_index' =>2,
					'badatz_index' =>3,

					/*restaurant meat dairy array*/
					'meat_dairy' => array
					(
						'',
						'Meat',
						'Dairy',
						'Parve'
					),
					'meat_index' =>1,
					'dairy_index' =>2,
					'parve_index' =>3,

					/*dish meat dairy array*/
					'mdv' => array
					(
						'',
						'Meat',
						'Dairy',
						'Veggy',
						'Parve',
					),
					'meat_index' =>4,
					'dairy_index' =>5,
                    'veggy_index' =>6,
					'parve_index' =>7,

					/*payment method array*/
					'payment_method' => array
					(
						'Both',
						'Credit Card',
						'Cash'
					),
					'credit_card_index' =>1,
					'cash_index' =>2,
					'both_index'=>3,
                    /*information delivery  method array*/
					'info_method' => array
					(
						'',
						'Email',
						'Fax',
                        'Sms'
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
						'ingredient' =>'Ingredient',
						'restaurant' =>'Restaurant',
						'dish' =>'Dish'
					),
					/*dish model size_unit array */
					'unit_arr' => array
					(
						''=>'',
						'ML' =>'ML (milli liter)',
						'L' =>'L (liter)',
						'GR' =>'GR (gram)',
						'KG' =>'KG (kilo)'
					),
				)
		);
