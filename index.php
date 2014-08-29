<?php
header('Content-Type: text/html; charset=UTF-8');
// phpinfo();

function connStrToArray($conn_str){
 
    // Initialize array.
    $conn_array = array();
 
    // Split conn string on semicolons. Results in array of "parts".
    $parts = explode(";", $conn_str);
 
 
    // Loop through array of parts. (Each part is a string.)
    foreach($parts as $part){
 
        // Separate each string on equals sign. Results in array of 2 items.
        $temp = explode("=", $part);
 
        // Make items key=>value pairs in returned array.
        $conn_array[$temp[0]] = $temp[1];
    }
 
    return $conn_array;
}

$connstring = getenv('MYSQLCONNSTR_DefaultConnection');
$connarray = connStrToArray($connstring);
$dbhost = $connarray['Data Source'];
$dbname = $connarray['Database'];

$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $connarray['User Id'], $connarray['Password']);

$STH_getlist = $DBH->query('SELECT Item, Measurement FROM shoppinglist');

$STH_getlist->setFetchMode(PDO::FETCH_ASSOC);

$html_table = '<table><tr><th>Item</th><th>Measurement</th></tr>';

while ($row = $STH_getlist->fetch()) {
	$html_table .= '<tr><td>'.$row['Item'].'</td><td>'.$row['Measurement'].'</td></tr>';
}

?>
<html>
	<head>
		<title>My Shopping List</title>
	</head>
	<body>
		<h1>My Shopping List</h1>
		<?php echo $html_table; ?>
		<h3>Add New List Item</h3>
		<form accept-charset="UTF-8">
			<label for="item_name">Item Name</label>
			<input name="item_name" type="text" value="Pærer"/>
			<label for="item_measure">Item Name</label>
			<input name="item_measure" type="text" value="5 stk."/>
			<input name="add" type="submit" value="Add Item" />
		</form>
	</body>
</html>
