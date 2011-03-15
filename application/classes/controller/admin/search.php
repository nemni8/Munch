<?php
/**
* Created by JetBrains PhpStorm.
* User: Omry
* Date: 15/03/11
* Time: 18:35
* To change this template use File | Settings | File Templates.
*/
$term=mysql_real_escape_string(addslashes($_GET['term'])) ;
$return_arr = array();
mysql_connect("localhost","root","") ;
mysql_select_db("munch") ;
$fetch = mysql_query("SELECT name FROM categories WHERE name LIKE '$term%'") ;

/* Retrieve and store in array the results of the query.*/

while ($row = mysql_fetch_assoc($fetch)) {
    //$row_array['value'] = $row['name'];
    $row_array['name'] = $row['name'];
    array_push($return_arr,$row_array);


}
/* Free connection resources. */
//mysql_close($conn);

/* Toss back results as json encoded array. */
echo json_encode(array_values($return_arr) );
 //echo $_GET['term'] . '(' . json_encode($return_arr) . ');';
;?>