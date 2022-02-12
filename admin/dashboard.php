<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin's Dashboard | Semaphore</title>

        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="../css/admin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    </head>
    <body>
                    <?php
                        session_start();
                        if (! empty($_SESSION['logged_in']))
                        {
                            //select data of admin
                            include '../connection/connect.php';
                            $query_admin = "SELECT * FROM tb_admin WHERE ADMIN_EMAIL = '$_SESSION[email]'";
                            $result_admin = mysqli_query($conn, $query_admin);

                            if(mysqli_num_rows($result_admin) > 0){
                                while($row = mysqli_fetch_assoc($result_admin)){
                                            $fname = $row["ADMIN_FNAME"] ;
                                            $lname = $row["ADMIN_LNAME"] ;
                                            $email = $row["ADMIN_EMAIL"] ;
                                            $id = $row["ADMIN_ID"] ;
                                }
                            }

                            
                            ?>
                         <?php
                       }
                        else
                        {
                            // access denied if user is not log in
                             header("location: ../index.php");
                             exit; 
                         }
                    ?>
            <?php /* <-- php resumes now */
            ?>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-network-chart'></i>
      <span class="logo_name">Payroll</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Employee</span>
          </a>
        </li>
        <li>
          <a href="#">
              <i class='bx bx-calendar'></i>
            <span class="links_name">Attendance</span>
          </a>
        </li>
        <li>
          <a href="#">
              <i class='bx bx-file'></i>
            <span class="links_name">Deductions</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Basic Rate</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Hours Work</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
         <span class="links_name" onclick="window.location.href='../logout.php';">
          <a href="#" style="color: white;">
            <i class='bx bx-log-out'></i>
              Log out
          </a></span>
        </li>
      </ul>
  </div>

  <section class="home-section">
     <nav>
       <div class="sidebar-button">
         <i class='bx bx-menu sidebarBtn'></i>
         <span class="employee_records">Employee Records</span>
       </div>
        <button type="button" class="btn btn-success"><i class='bx bx-plus' ></i>Add Employee</button>
       <div class="search-box">
         <input type="text" name="search_text" id="search_text" placeholder="Search Employee">
         <i class='bx bx-search' ></i>
       </div>
       <div class="profile-details">
         <!--<img src="images/profile.jpg" alt="">-->
         <span class="admin_name">Administrator <br>
         <?php  echo $fname . " " . $lname;?> </span>
         <i class='bx bx-chevron-down' ></i>
       </div>
     </nav>

     <div class="container search-table">
             <div class="search-box">
                 <div class="row">
                     <div class="col-md-3">
                         <h5>Search All Fields</h5>
                     </div>
                 </div>
             </div>
       <div id="result"></div>
   </div>
  </section>
 </body>
</html>

<script>
   //prevent form resubmission when page is refreshed
   if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
   }
</script>

<script>
    //search filter
      $(document).ready(function(){
       load_data();
        function load_data(query)
        {
         $.ajax({
          url:"search_filters.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
        $('#result').html(data);
          }
         });
        }
        $('#search_text').keyup(function(){
         var search = $(this).val();
         if(search != ''){
          load_data(search);
         }else{
          load_data();
         }
        });
      });
 </script>

<script>
    //sidebar
   let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
      if(sidebar.classList.contains("active")){
           sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
       }else
           sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
</script>