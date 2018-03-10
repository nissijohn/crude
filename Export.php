<?php  
require_once 'config.php';
if(isset($_POST["export"]))  
{

 header('Content-Type: text/csv; charset=utf-8');  
   header('Content-Disposition: attachment; filename=data.csv'); 
  $output = fopen("php://output", "w");  
  fputcsv($output, array('Sr.No.', 'Name', 'Address', 'Salary')); 
 $query = "SELECT * FROM employees"; 
  $result = $pdo->query($query);  
      while($row = $result->fetch())  
      {  
           fputcsv($output, $row);  
      }  
     unset($result); 
}
 
?>