<!DOCTYPE html>

<?php include 'header.php'?> <!-- to include the navigation bar -->
<?php include 'config.php'?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 750px; 
            margin: 0 auto;
        }
        ul { 
          margin:0; 
          padding:0; 
          } 
          
        nav > ul {margin-top: 0; margin-bottom : 0; padding:0;}
        th {
          background-color: #ff3333;
          color: white;
           }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        table tr td {
            text-align:center;
        }
        table th {
            text-align:center;
        }
        table {
            
            border-collapse: collapse;
             width: 100%;
             }
             
table {
    border: 1px solid grey;
}
        h1.aligncenter {
            text-align: center;
        }
        
        .centertable { width: 750px; } 
         a[disabled="disabled"] {
        pointer-events: none;
        color:gray
    }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
         
            $('[data-toggle="tooltip"]').tooltip();   
          $('#btnDelete').click(function()
           {
               $('.delete').removeAttr('disabled');  // to enable the delete glyphcon when the delete employee link is clicked
             
           });
           
           // The following code block identifies the row id to be deleted
           $('.delete').click(function()
           {
             var id=$(this).attr('id');
             var str= id.split("_");
             var hiddenVal= str[1];
          
            document.getElementById("hiddenVal").value = hiddenVal; // saves the id of te row to a hidden variable
           });
           
           $('.btnClose').click(function()
           {
             $('.delete').attr('disabled','disabled');  // to disable the delete glyphcon while closing the modal pop-ups
           });
           
        });
        
         
        
        
    </script>
</head>
<body>
     <div class="page-header" style="background-color:#ff3333;"> <!-- changed the background colour of the header-->
                        <h1 class="aligncenter" style="color:white;">LIST OF EMPLOYEES</h1>
                        
                    </div>
    <div class="wrapper">
        <div class="container-fluid centertable">
           
                   
             <div class="row">
                 <div style="width:800px;">
                     <div class="pull-right">
                     <form action="export.php" method="post"> <!-- Form method which deals with the export functionality-->
                                 <input  type="submit" name="export" class="btn btn-danger" value="Export to Excel" >
                             </form>
                         </div>
                     <div class="row">
                         <div class="col-sm-6">
                   <a href="#" style="color:red;" data-toggle="modal" data-target="#AddModal" >Add an employee</a>
                    </div>
                         <div class="col-sm-12"> <!-- button which enables the delete glyphcon -->
                              <a href="#" style="color:red;"id="btnDelete">Delete an employee</a>
                    
                    </div>
             
                    </div>
                    <br/>
                    
                    <?php
                  
                    // Retrieve data from DB by checking whether it is a search query result or normal page load
                    if( isset($_POST['srch-term']) &&!empty(trim($_POST['srch-term']))){
                        $word=$_POST["srch-term"];
                        $sql="SELECT * FROM employees WHERE (name LIKE '%" . $word . "%') or (address LIKE '%" . $word . "%')  ORDER BY name";
                    } // query used in the case of a search
                    else
                    {
                    $sql = "SELECT * FROM employees"; // query used in the case of a normal index page load 
                   
                    }
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table  table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                         echo "<th> </th>";
                                        echo "<th>ID</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Salary</th>";
                
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>";
                                            echo "<a href='#' data-toggle='modal' data-target='#DeleteModal' title='Delete Record'  class='delete' id='btnDeleteGlyph_" . $row['id'] . "'  disabled='disabled' data-toggle='tooltip'><span class='glyphicon glyphicon-remove'></span></a>";
                                        echo "</td>";
                                       
                                        echo "<td> <a href='read.php?id=". $row['id'] ."'>" . $row['id'] ."</a></td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                        
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                    }
                    
                    // Close connection
                    unset($pdo);
                    ?>
                </div>
            </div>        
        </div>
    </div>
    
    <!--Modal pop up for deleting details of an employee -->
    <div id="DeleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close btnClose" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete an Employee</h4>
      </div>
      <div class="modal-body">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form method="post" action="delete.php">
                        <div class="alert" style="color:red;">
                            <input type="text" style="display:none" id="hiddenVal" name="id" value=""/> 
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                               <input type="submit" class="btn btn-danger" value="Yes">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
    </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default btnClose" data-dismiss="modal">Close</button>
      </div>
        </div>
    </div>
  </div>
        
        <!-- Modal pop up for adding a new employee, implemented using bootstrap-->
        <div id="AddModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add an Employee</h4>
      </div>
      <div class="modal-body">
      <?php
// Include config file

$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
?>
           <div class="wrapper">
        <div class="container-fluid">
                    <form action="create.php" method="post">
                          <div class="row">
                        <div class="form-group">
                              <div class="col-sm-2">
                            <label>Name:</label>
                             </div>
                                <div class="col-sm-6">
                            <input type="text" name="add_name" class="form-control">
                            <span class="help-block"></span>
                                </div>
                        </div>
                          </div>
                        <div class="row">
                        <div class="form-group">
                             <div class="col-sm-2">
                            <label>Address:</label>
                             </div>
                             <div class="col-sm-6">
                            <textarea name="add_address" class="form-control"></textarea>
                            <span class="help-block"></span>
                             </div>
                        </div>
                            </div>
                         <div class="row">
                        <div class="form-group">
                             <div class="col-sm-2">
                            <label>Salary:</label>
                             </div>
                             <div class="col-sm-6">
                            <input type="text" name="add_salary" class="form-control" >
                            <span class="help-block"></span>
                             </div>
                        </div>
                         </div>
                        <input type="hidden" value="set" name="add"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                         </form>
                          </div> 
        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
        </div>
    </div>
  </div>
        
        
</body>
</html>