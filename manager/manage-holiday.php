<?php 
    require_once "include/header.php";
?>


<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM holiday";
$result = mysqli_query($conn , $sql);

$i = 1;
$you = "";


?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="container bg-white shadow">
    <div class="py-4 mt-5"> 
    <div class='text-center pb-2'><h4>Manage Holidays</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>S.No.</th>
        <th>Holiday Id</th>
        <th>Name</th>
        <th>Start Date</th>
        <th>End date</th>
        <th>No of days</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $holiday_name= $rows["holiday_name"];
            $startdate = $rows["startdate"];
            $enddate = $rows["enddate"];
            $holiday_id = $rows["holiday_id"];

            if($startdate == "" || $enddate == ""){
                $startdate = "Not Defined";
                $enddate = "Not Defined";
                $no_of_days = "Not Defined";
            }else{
                $date1=date_create($startdate);
                $date2=date_create($enddate);
                $diff=date_diff($date1,$date2);
                $no_of_days = 1+($diff->format("%a")); 
                $startdate = date('jS F, Y', strtotime($startdate));
                $enddate = date('jS F, Y', strtotime($enddate));
            }
            
            ?>
        <tr>
        <td><?php echo "{$i}."; ?></td>
        <td><?php echo $holiday_id; ?></td>
        <td> <?php echo $holiday_name ; ?></td>
        <td><?php echo $startdate; ?></td>
        <td><?php echo $enddate; ?></td>
        <td><?php echo $no_of_days, " days"; ?></td>

        <td>  <?php 
                $edit_icon = "<a href='edit-holiday.php?holiday_id= {$holiday_id}' class='btn-sm btn-primary float-right ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
                $delete_icon = " <a href='delete-holiday.php?holiday_id={$holiday_id}' holiday_id='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
                echo $edit_icon . $delete_icon;
             ?> 
        </td>

      
        

    <?php 
            $i++;
            }
        }else{
            echo "<script>
            $(document).ready( function(){
                $('#showModal').modal('show');
                $('#linkBtn').attr('href', 'add-holiday.php');
                $('#linkBtn').text('Add Holiday');
                $('#addMsg').text('No Holidays Found!');
                $('#closeBtn').text('Remind Me Later!');
            })
         </script>
         ";
        }
    ?>
     </tr>
    </table>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>

<?php 
    require_once "include/footer.php";
?>