<div class="search-list">
<?php
ob_start();

include "../connection/connect.php";
$output = '';
if(isset($_POST["query"]))
{

 //search employees
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM tb_employee WHERE EMP_ID LIKE '%".$search."%' OR EMP_FNAME LIKE '%".$search."%'
 OR EMP_LNAME LIKE '%".$search."%'  OR EMP_ LIKE '%".$search."%' OR EMP_EMAIL LIKE '%".$search."%'  
 OR EMP_STATUS LIKE '%".$search."%' OR EMP_POSITION LIKE '%".$search."%'";
 
}else{
 $query = "SELECT * FROM tb_employee ORDER BY EMP_ID";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0) {
 $totalfound = mysqli_num_rows($result);
  $output .= '<h3>'.$totalfound.' Records Found</h3>
  <table class="table table-striped custab">
  <thead>
      <tr>
         <th>ID</th>
         <th></th>
         <th></th>
         <th>Name</th>
         <th></th>
         <th></th>
         <th>Employee Status</th>
         <th></th>
         <th></th>
         <th>Hours Worked</th>
         <th></th>
         <th></th>
         <th>Overtime</th>
         <th></th>
         <th></th>
         <th>Position</th>
         <th></th>
         
         <th>Action</th>
      </tr>
  </thead>
  <tbody>';
 while($row = mysqli_fetch_array($result))
 {
      $emp = $row["EMP_ID"];
      $query3 = "SELECT * FROM tb_employee WHERE EMP_ID = '$emp'";
      $result3 = mysqli_query($conn, $query3);
      if(mysqli_num_rows($result3) > 0) {
             while($row1 = mysqli_fetch_array($result3)){
                $emp_name = $row1["EMP_FNAME"] . " " . $row1["EMP_LNAME"];

             }
      }

         echo '<form action="search_filter.php" method="post">';
         $confirm = 'onclick="if(confirm("Are you sure?")) saveandsubmit(event);"';
         $output .= '
         <tr>
            <td>'.$row["EMP_ID"].'</td>
            <td></td>
            <td></td>
            <td>'.$emp_name.'</td>
            <td></td>
            <td></td>
            <td>'.$row["EMP_STATUS"].'</td>
            <td></td>
            <td></td>
            <td> 10 hrs</td> 
            <td></td>
            <td></td>
            <td> 3 hrs</td>
            <td></td>
            <td></td>
            <td>'.$row["EMP_POSITION"].'</td>
            <td></td>
            <td><a href="search_filter.php?id='.$row['EMP_ID'].'" id="btn" onclick="return confirm(\'Are you sure you want to delete this client?\');">
            <span class="glyphicon glyphicon-pencil"></span></a></td>  
         </form>
       </tr>';
      }
 echo $output;
}else{
 echo 'No Record Found';
}

  //delete clients
   if(isset($_GET['EMP_ID'])){
              $id = $_GET['EMP_ID'];
              $query4 = "DELETE FROM tb_employee WHERE EMP_ID = '$id'";  
              $result4 = mysqli_query($conn,$query4);  
              if ($result4) {  
                     header("Refresh:0;url=dashboard.php");
         }
      }

       ob_end_flush();
?>
    </tbody>
  </table>
</div>
<script>
   //prevent form resubmission when page is refreshed
   if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
   }
</script>
<style>
.glyphicon-trash{
   color: white;
   margin-left: 30%;
   background-color: #D2322D;
   border-radius: 4px;
   padding:5px;}
.a{
   margin:0;
   padding: 0;
}
</style>