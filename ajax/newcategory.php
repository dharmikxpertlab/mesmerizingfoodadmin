<?php 
include '../include/dbConnection.php';
$id = $_REQUEST['data'] ;

?>
        <div class="form-group row"  id="<?php echo $id;?>">
            <div class="col-lg-2"></div>
            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;"></span><strong></strong> </label>
            
            <div class="col-lg-4">
                    
                <select name="cuisineId[]" id="category" class="form-control">
                <option value='' selected>Select Category</option>
                    <?php
                    
                    $result = mysqli_query($connection,"select * from `cuisines` where `delete` = 0");
                    while ($row = mysqli_fetch_assoc($result)) {
                        if($row['cuisineId']==$cuisineId){
                            echo "<option value='$row[cuisineId]' selected>$row[cuisineName]</option>";
                        }else{
                            echo "<option value='$row[cuisineId]'>$row[cuisineName]</option>";
                        }
                        
                    }
                    ?>
                    
                </select>
                <?php if(isset($cuisinesError)) { echo $cuisinesError; } ?>
            </div>
            <div id="remove" class="col-md-4" ><a onclick="remove_ui_ux('<?php echo $id;?>')" class="btn btn-sm font-weight-bolder btn-light-danger"><i class="la la-trash-o"></i>Delete</a></div>
        </div>
        