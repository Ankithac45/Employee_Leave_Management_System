<?php 
    require_once "include/header.php";
?>


<?php  

        $holiday_nameErr = $startdateErr = $enddateErr = "";
        $holiday_name = $startdate = $enddate = "";

        if( $_SERVER["REQUEST_METHOD"] == "POST" ){

            if( empty($_REQUEST["startdate"]) ){
                $startdate ="";
            }else {
                $startdate = $_REQUEST["startdate"];
            }


            if( empty($_REQUEST["enddate"]) ){
                $enddate = "";
            }else {
                $enddate = $_REQUEST["enddate"];
            }

            if( empty($_REQUEST["holiday_name"]) ){
                $holiday_nameErr = "<p style='color:red'> * Name is required</p>";
            }else {
                $holiday_name = $_REQUEST["holiday_name"];
            }

            if( !empty($holiday_name)  )

                // database connection
                require_once "../connection.php";

                $sql_select_query = "SELECT holiday_name FROM holiday WHERE holiday_name = '$holiday_name' ";
                $r = mysqli_query($conn , $sql_select_query);

                if( mysqli_num_rows($r) > 0 ){
                    $holiday_nameErr = "<p style='color:red'> * Holiday Already Register</p>";
                } else{

                    $sql = "INSERT INTO holiday( holiday_name , startdate , enddate ) VALUES( '$holiday_name' , '$startdate' , '$enddate' )  ";
                    $result = mysqli_query($conn , $sql);
                    if($result){
                     $holiday_name = $startdate = $enddate = "";
                        echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-holiday.php');
                            $('#linkBtn').text('View Holidays');
                            $('#addMsg').text('Holiday Added Successfully!');
                            $('#closeBtn').text('Add More?');
                        })
                     </script>
                     ";
                    }
                    
                }

            }
        

?>



<div style=""> 
<div class="login-form-bg h-100">
        <div class="container  h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-4 shadow">                       
                                    <h4 class="text-center">Add New Holiday</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >Holiday Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $holiday_name; ?>"  name="holiday_name" >
                                   <?php echo $holiday_nameErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Start Date :</label>
                                    <input type="date" class="form-control" value="<?php echo $startdate; ?>" name="startdate" >  
                                   
                                </div>

                                <div class="form-group">
                                    <label >End Date :</label>
                                    <input type="date" class="form-control" value="<?php echo $enddate; ?>" name="enddate" >  
                                   
                                </div>
                               
                                <br>

                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>


