<?php
require_once('../private/initialize.php');

require_once('connection.php');
$connection = db_connect();

$stmt = $connection->prepare("SELECT * FROM product JOIN image ON product.product_id = image.product_id LIMIT 4");

$stmt->execute();

$featured_products = $stmt->get_result();



/*$featured_products = $connection->query("SELECT * FROM product JOIN image ON product.product_id = image.product_id LIMIT 4");

Another option to get data. 

Personal notes from research about which option is better:

*It is generally better to use prepare() over query() for two main reasons:

1. Security: prepare() is a more secure way of interacting with your database, as it helps to prevent SQL injection attacks. 
When you use prepare(), you can bind parameters to the statement, which ensures that any user input is properly escaped and quoted before being sent to the database.

2. Performance: When you use query(), PHP sends the entire SQL statement to the database for parsing and execution each time the statement is executed. This can be 
slow if you are executing the same statement multiple times with different parameters. prepare(), on the other hand, only needs to be parsed once, 
and can be executed multiple times with different parameters.

So, in summary, prepare() is generally the safer and more performant option for interacting with your database.

*/
