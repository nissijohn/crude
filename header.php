<!doctype html>

  <head>
   
  <title>Crud Application</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
  </head>
  <script type="text/javascript">
      
      </script>
<nav class="navbar navbar-inverse" style="border-color: #ff9999; border-width:3px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CRUD</a>
    </div>
      <!-- Adding a navigation bar to the main page -->
    <ul class="nav navbar-nav">
        <!-- Adding a Home page which redirects to te main index page from wherever it is clicked -->
      <li class="active"><a href="index.php">Home</a></li> 
     
    </ul>
      <!-- The following div implements the search functionality. The user can search for a specific employee-->
     <div class="col-sm-3 col-md-3 pull-right">
         <form class="navbar-form" role="search" action="index.php" method="post">
          <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="search_term">
            <div class="input-group-btn">
               
                <button class='btn btn-default' id='btnSearch' ><i class='glyphicon glyphicon-search'></i></button>";
                   
                </div>
          </div>
            </form>
          </div> 
     
  </div>
     
</nav>
      
</div>
