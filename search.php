<?php
//if we got something through $_POST
if(isset($_POST['search'])){
    // here you would normally include some database connection
    require_once 'config.php';
  
    // never trust what user wrote! We must ALWAYS sanitize user input
    //$word = mysql_real_escape_string($_POST['search']);
    $word = $_POST['search'];
    // build your search query to the database
    $sql = "SELECT name FROM employees WHERE (name LIKE '%" . $word . "%') or (address LIKE '%" . $word . "%')  ORDER BY name";
    // get results
    $row = $pdo->query($sql);
    if(count($row)) {
        $end_result = '';
        foreach($row as $r) {
            $result         = $r['name'];
            // we will use this to bold the search word in result
            $bold           = '<span class="found">' . $word . '</span>';    
            $end_result     .= '<li>' . str_ireplace($word, $bold, $result) . '</li>';            
        }
        echo $end_result;
    } else {
        echo '<li>No results found</li>';
    }
}
echo $word;
?>



