<div class="search-list">
<?php
ob_start();

include "../connection/connect.php";
$output = '';
if(isset($_POST["query"]))
{

 //search employees
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM tb_deduction WHERE DEDUCTION_ID LIKE '%".$search."%' OR DEDUCTION_NAME LIKE '%".$search."%'
 OR DEDUCTION_FEE LIKE '%".$search."%'";
 
}else{
 $query = "SELECT * FROM tb_deduction ORDER BY DEDUCTION_ID";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0) {
 $totalfound = mysqli_num_rows($result);
 $output .=
  '<table class="table table-striped custab">
  <thead>
      <tr>
         <th>ID</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th>Deduction Name</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th>Deduction Fee</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
      </tr>
  </thead>
  <tbody>';
 while($row = mysqli_fetch_array($result)){
      $deduction = $row["DEDUCTION_ID"];
      $query3 = "SELECT * FROM tb_deduction WHERE DEDUCTION_ID = '$deduction'";
      $result3 = mysqli_query($conn, $query3);
      if(mysqli_num_rows($result3) > 0) {
             while($row1 = mysqli_fetch_array($result3)){
                $deduction_name = $row1["DEDUCTION_NAME"];

             }
      }

         echo '<form action="deduction_filter.php" method="post">';
         $confirm = 'onclick="if(confirm("Are you sure?")) saveandsubmit(event);"';
         $output .= '
         <tr>
            <td>'.$row["DEDUCTION_ID"].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$deduction_name.'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$row["DEDUCTION_FEE"].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><a href="deduction_filter.php?id='.$row['DEDUCTION_ID'].'" id="btn">
            <span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="deduction_filter.php?id='.$row['DEDUCTION_ID'].'" id="btn" onclick="return confirm(\'Are you sure you want to delete this client?\');">
            <span class="glyphicon glyphicon-trash"></span></a></td>  
              
         </form>
       </tr>';
      }
 echo $output;
}else{
 echo 'No Record Found';
}

  //delete clients
   if(isset($_GET['DEDUCTION_ID'])){
              $id = $_GET['V'];
              $query4 = "DELETE FROM tb_deduction WHERE DEDUCTION_ID = '$id'";  
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