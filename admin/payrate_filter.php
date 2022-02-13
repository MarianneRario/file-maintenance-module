<div class="search-list">
<?php
ob_start();

include "../connection/connect.php";
$output = '';
if(isset($_POST["query"]))
{

 //search employees
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM tb_payrate WHERE POSITION_ID LIKE '%".$search."%' OR POSITION_NAME LIKE '%".$search."%'
 OR POSITION_RATE LIKE '%".$search."%'  OR POSITION_BONUS LIKE '%".$search."%'";
 
}else{
 $query = "SELECT * FROM tb_payrate ORDER BY POSITION_ID";
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
         <th></th>
         <th></th>
         <th>Position Name</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th>Position Rate</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th>Position Bonus</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
      </tr>
  </thead>
  <tbody>';
 while($row = mysqli_fetch_array($result))
 {
      $pos = $row["POSITION_ID"];
      $query3 = "SELECT * FROM tb_payrate WHERE POSITION_ID = '$pos'";
      $result3 = mysqli_query($conn, $query3);
      if(mysqli_num_rows($result3) > 0) {
             while($row1 = mysqli_fetch_array($result3)){
                $pos_name = $row1["POSITION_NAME"];

             }
      }

         echo '<form action="payrate_filter.php" method="post">';
         $confirm = 'onclick="if(confirm("Are you sure?")) saveandsubmit(event);"';
         $output .= '
         <tr>
            <td>'.$row["POSITION_ID"].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$pos_name.'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$row["POSITION_RATE"].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>'.$row["POSITION_BONUS"].'</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><a href="deduction_filter.php?id='.$row['POSITION_ID'].'" id="btn">
            <span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="deduction_filter.php?id='.$row['POSITION_ID'].'" id="btn" onclick="return confirm(\'Are you sure you want to delete this client?\');">
            <span class="glyphicon glyphicon-trash"></span></a></td>   
         </form>
       </tr>';
      }
 echo $output;
}else{
 echo 'No Record Found';
}

  //delete clients
   if(isset($_GET['POSITION_ID'])){
              $id = $_GET['EMP_ID'];
              $query4 = "DELETE FROM tb_payrate WHERE POSITION_ID = '$id'";  
              $result4 = mysqli_query($conn,$query4);  
              if ($result4) {  
                     header("Refresh:0;url=payrate.php");
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