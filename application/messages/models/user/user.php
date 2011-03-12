 /**
 * Created by JetBrains PhpStorm.
 * User: Omry
 * Date: 11/03/11
 * Time: 14:09
 * To change this template use File | Settings | File Templates.
 */
public function rules() {

return array(
    'username' => array(
        'not_empty' => 'You must provide a username.',
        'min_length' => 'The username must be at least :param2 characters long.',
        'max_length' => 'The username must be less than :param2 characters long.',
        'username_available' => 'This username is not available.',
    ),
    'password' => array(
        'not_empty' => 'You must provide a password.',
    ),
);

