<?php

require 'config.php';
if( isset($_POST['add_name']) &&!empty(trim($_POST['add_name']))){
    // Validate name
    
    echo 'reached create';
    $input_name = trim($_POST["add_name"]);

    
    // Validate address
    $input_address = trim($_POST["add_address"]);
   
    
    // Validate salary
    $input_salary = trim($_POST["add_salary"]);
    
    // Check input errors before inserting in database
   
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary) VALUES (:name, :address, :salary)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':name', $param_name);
            $stmt->bindParam(':address', $param_address);
            $stmt->bindParam(':salary', $param_salary);
            
            // Set parameters
            $param_name = $input_name;
            $param_address = $input_address;
            $param_salary = $input_salary;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                echo 'executed';
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    
    
    // Close connection
    unset($pdo);
}
?>