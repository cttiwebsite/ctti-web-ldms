<?php

//export.php
$connect = mysqli_connect("localhost", "root", "root", "import_export");
$output = '';
if(isset($_POST["export"])) {
    $query = "SELECT * FROM book";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0) {
        $output .= '
   <table class="table" bordered="1">  
      <tr>
       <th>Book Title</th>  
       <th>Author</th>  
       <th>Publisher Name</th>  
       <th>ISBN</th>
       <th>Copyright Year</th>
      </tr>
  ';
        while($row = mysqli_fetch_array($result)) {
            $output .= '
    <tr>  
     <td>'.$row["book_title"].'</td>
     <td>'.$row["author"].'</td>  
     <td>'.$row["publisher_name"].'</td>  
     <td>'.$row["isbn"].'</td>  
     <td>'.$row["copyright_year"].'</td>
   </tr>
   ';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=export_download.xls');
        echo $output;
    }
}
