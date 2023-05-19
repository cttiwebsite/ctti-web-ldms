<?php
$connect = mysqli_connect("localhost", "root", "root", "import_export");
$sql = "SELECT * FROM book";
$result = mysqli_query($connect, $sql);

$output = '';
if(isset($_POST["import"])) {
    $tmp = explode(".", $_FILES["excel"]["name"]);
    $extension = end($tmp); // For getting Extension of selected file
    $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
    if(in_array($extension, $allowed_extension)) { //check selected file extension is present in allowed extension array
        $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
        //include("PHPSpreadsheet/IOFactory.php"); // Add PHPExcel Library in this code
        require 'PHPExcel/Classes/PHPExcel.php';
        include("PHPExcel/Classes/PHPExcel/IOFactory.php");
        $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

        $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            for($row=2; $row<=$highestRow; $row++) {
                $output .= "<tr>";
                $book_title = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                $author = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                $publisher_name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                $isbn = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                $copyright_year = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                $query = "INSERT INTO book(book_title, author, publisher_name, isbn, copyright_year) VALUES ('".$book_title."', '".$author."', '".$publisher_name."', '".$isbn."', '".$copyright_year."')";
                mysqli_query($connect, $query);
                $output .= '<td>'.$book_title.'</td>';
                $output .= '<td>'.$author.'</td>';
                $output .= '<td>'.$publisher_name.'</td>';
                $output .= '<td>'.$isbn.'</td>';
                $output .= '<td>'.$copyright_year.'</td>';
                $output .= '</tr>';
            }
        }
        $output .= '</table>';

    } else {
        $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
    }
}
?>
<html>  
 <head>  
  <title>Import & Export MySQL data to Excel in PHP</title>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 </head>  
 <body>  
  <div class="container">  
   <br />  
   <br />  
   <br />  
   <div class="table-responsive">  
    <h2 align="center">Export MySQL data to Excel in PHP</h2><br /> 
    <table class="table table-bordered">
     <tr>  
       <th>Book Title</th>  
       <th>Author</th>  
       <th>Publisher Name</th>  
       <th>ISBN</th>
       <th>Copyright Year</th>
      </tr>
     <?php
     while($row = mysqli_fetch_array($result)) {
         echo '  
       <tr>  
         <td>'.$row["book_title"].'</td>
         <td>'.$row["author"].'</td>  
         <td>'.$row["publisher_name"].'</td>  
         <td>'.$row["isbn"].'</td>  
         <td>'.$row["copyright_year"].'</td>
       </tr>
      ';
     }
?>
    </table>
    <br />
    <form method="post" action="export.php">
     <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>
    <form method="post" enctype="multipart/form-data">
      <label>Select Excel File</label>
      <input type="file" name="excel" />
      <br />
      <input type="submit" name="import" class="btn btn-info" value="Import" />
    </form>
    <br />
    <br />
    <?php
 echo $output;
?>
   </div>  
  </div>  
 </body>  
</html>
