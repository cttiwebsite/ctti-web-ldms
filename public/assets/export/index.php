<?php
mysql_select_db('eb_lms', mysql_connect('localhost', 'root', ''))or die(mysql_error());
?>

<?php
  $DB_Server = "localhost";
$DB_Username = "root";
$DB_Password = "";
$DB_DBName = "eb_lms";
$DB_TBLName = "book";
$xls_filename = 'Book_list'.date('Y-m-d').'.xls';

$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Failed to connect to MySQL:<br />" . mysql_error() . "<br />" . mysql_errno());

$Db = @mysql_select_db($DB_DBName, $Connect) or die("Failed to select database:<br />" . mysql_error(). "<br />" . mysql_errno());

$sql = "Select * from $DB_TBLName";
$result = @mysql_query($sql, $Connect) or die("Failed to execute query:<br />" . mysql_error(). "<br />" . mysql_errno());

// Header info settings
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=$xls_filename");
header("Pragma: no-cache");
header("Expires: 0");

/***** Start of Formatting for Excel *****/
// Define separator (defines columns in excel &amp; tabs in word)
$sep = "\t"; // tabbed character

// Start of printing column names as names of MySQL fields
for ($i = 0; $i<mysql_num_fields($result); $i++) {
    echo mysql_field_name($result, $i) . "\t";
}
print("\n");
// End of printing column names

// Start while loop to get data
while($row = mysql_fetch_row($result)) {
    $schema_insert = "";
    for($j=0; $j<mysql_num_fields($result); $j++) {
        if(!isset($row[$j])) {
            $schema_insert .= "NULL".$sep;
        } elseif ($row[$j] != "") {
            $schema_insert .= "$row[$j]".$sep;
        } else {
            $schema_insert .= "".$sep;
        }
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
}
?>
 

 