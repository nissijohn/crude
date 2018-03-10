<?php include 'header.php';?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once 'config.php';
    
    // Prepare a select statement
    $sql = "SELECT * FROM employees WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(':id', $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Retrieve individual field value
                $id= $row["id"];
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="row">
                    <div class="form-group">
                        <div class="col-sm-3"> <label>NAME</label></div>
                        <div class="col-sm-8"> <input type="text" name="name" class="form-control"  disabled="true" value="<?php echo $name; ?>"></div>
                        
                    </div>
                        </div>
                    <br/>
                     <div class="row">
                    <div class="form-group">
                        <div class="col-sm-3"><label>ADDRESS</label></div>
                        <div class="col-sm-8"><input type="text" name="name" class="form-control"  disabled="true" value="<?php echo $address; ?>"></div>
                    </div>
                         </div>
                    <br/>
                      <div class="row">
                    <div class="form-group">
                        <div class="col-sm-3"><label>SALARY</label></div> 
                        <div class="col-sm-8"><input type="text" name="name" class="form-control"  disabled="true" value="<?php echo $salary ; ?>"></div>
                    </div>
                          </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-6">
                    <a href="index.php" class="btn btn-danger">Back</a>
                    </div>
                        <div class="col-sm-6">
                            <?php
                            echo "<a href='update.php?id=" . $id . "' class='btn btn-danger'>Update</a>" ;
                                    ?>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>