<?php
require 'databasecon.php';
if($_SESSION['Username']){


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" type="image/png" href="Assets/icons/favicon.png" >
        <link rel="stylesheet" href="Design/bootstrap.min.css" type="text/css">
        <title>Bortech Visitors tracker</title>
        <meta charset="UTF-8">
        <meta name="description" content="Records of Visitors in Bortech's company" lang="en">
        <meta name="keywords" content="HTML,CSS,PHP,JavaScript">
        <meta name="Author" content="Dexter">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=7">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta lang="en">
        
    </head>
    <script src="jquery.js"></script>
    <script src="Design/bootstrap.min.js"></script>
    <script src="Design/datatables.min.js"></script>
   
            
    <body class="">
        <header class=" ">
            <nav class="navbar navbar-expand-sm bg-light justify-content-center d-inline-block container-fluid nav-pills">
                <div class="container-fluid">
                <a class="navbar-brand" href="#"> <img src="Assets/icons/favicon.png" width="80" height="80" class=" float-start" alt="Company-Logo" ></a>

  
                   

                    <div class="float-end">
                    
                            <div class="dropdown d-flex container-fluid">

                                <p class=" text-primary ">
                                    <?php echo $_SESSION['Username'] ; ?>
                                    <img src="Assets/icons/users-16/png-24/profile-24x24-1214445.png" class="justify-content-left" alt="user-icon">
                                </p>
                                    <a
                                        class="btn dropdown-toggle p-0"
                                        href="#"
                                        role="button"
                                        id="dropdownMenuLink"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        >
                                    </a>    

                                    <ul class=" dropdown-menu dropdown-menu-dark " aria-labelledby="dropdownMenuLink">
                                        <li ><a  href="index.php?PageName=addUser" class="dropdown-item " id="">Add Admin</a></li>
                                        <li ><a  href="index.php?PageName=updateprofile" class="dropdown-item " id="">Update Profile</a></li>
                                        <li ><a  href="logout.php" class="dropdown-item">Log Out</a></li>
                                    
                                    </ul>
                                        
                                
                                
                            </div>
                    </div>
            </div>


            <div>
            <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>    
            <ul class="navbar-nav justify-content-center ">
                <li class="nav-item px-3 page-item"><a href="Dashboard" class="nav-link page-link link">Dashboard</a></li>
                <li class="nav-item px-3 page-item" ><a href="addvisitor" class="nav-link page-link link" id="">Add Visitor</a></li>
                <li class="nav-item px-3 page-item" ><a href="visitor" class="nav-link page-link link" id="">Search Visitors</a></li>
                <li class="nav-item px-3 page-item" ><a href="report" class="nav-link page-link link" id="" >Report</a></li>
            </ul>  
            </div>
                
            </nav>
        </header>
        
        <div id="content" class=" justify-content-center ml-4">
            <?php
            $PagesDirectory = 'Pages';
           
            if(!empty($_GET['PageName']))
             {  
             
                 $folder = scandir($PagesDirectory);
                 
                 unset($folder[0],$folder[1]);
                 $page = $_GET['PageName'];
                 if(in_array($page.'.inc.php',$folder))
                 {
                    include 'Pages/'.$page.'.inc.php';
                 }
                 else{
                     echo' You are lost';
                 }
             }
             else{
                 include 'Pages/Dashboard.inc.php';
             }
            
            ?>




        </div>
        


        <footer class="footer bg-dark">
            <p class="text-center text-light ">&copy;Bortech <?php echo date('Y')?></p>
        </footer>

        <style>
    /* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
  width: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
  width: auto;
  
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  line-height: 60px; /* Vertically center the text there */
  background-color: #f5f5f5;
}
</style>
<script>

$(document).ready(function(){
    
    $('.suc').fadeOut(2000);
  
    $('.link').click(function(e){
        e.preventDefault()
        var li = $(this).attr('href')
        $('#content').fadeOut(-1000).load('Pages/'+li+'.inc.php').fadeIn(2000)
        
        
    })
    
       
});

</script>
    </body>


</html>

<?php
 }
    else{
        header('location: login.php');
    }

?>