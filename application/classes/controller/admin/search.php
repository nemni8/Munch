<?php

$term = mysql_real_escape_string(addslashes($_GET['term'])) ;
$return_arr = array();
$fetch = mysql_query("SELECT name FROM ingredients WHERE name LIKE '$term%'") ;
/* Retrieve and store in array the results of the query.*/
while ($row = mysql_fetch_assoc($fetch)) 
{
    $row_array['name'] = $row['name'];
    array_push($return_arr,$row_array);
}
return json_encode($return_arr) ;
;?>