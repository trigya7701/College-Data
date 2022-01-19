<?php include'connect.php';



if($_SERVER['REQUEST_METHOD']=='POST' && (isset($_POST['edit']) || isset($_POST['delete']))){

        if(isset($_POST['delete'])){

            $deleteId=$_POST['delete'];

            $deleteDataSql="DELETE FROM `faculty` WHERE `f_id`=$deleteId";
            $deleteDataResult=mysqli_query($conn,$deleteDataSql);

            if($deleteDataResult){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>Data deleted.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Something went wrong!</strong> Could not delete data.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
          
            
        }

        if(isset($_POST['edit'])){

            $updateId=$_POST['edit'];
            header('Location: edit.php?id='.$updateId);
            exit;
            
        }
}



    $displayDataSql="SELECT * FROM `faculty`";
    $displayDataResult=mysqli_query($conn,$displayDataSql);

    if($displayDataSql){

        if(mysqli_num_rows($displayDataResult)){


            echo'<div class="container my-5 py-5">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col">Subject</th>
                        <th scope="col"> Edit/Delete</th>
                        
                    </tr>
                </thead>
                <tbody>';

                while($row=mysqli_fetch_assoc($displayDataResult)){
                    echo'<tr>
                    <th scope="row">'.$row['f_id'].'</th>
                    <td>'.$row['f_name'].'</td>
                    <td>'.$row['f_age'].'</td>
                    <td>'.$row['f_phone'].'</td>
                    <td>'.$row['f_subject'].'</td>
                    <td>
                        <form action="" method="POST">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="submit" class="btn btn-warning btn-sm me-md-2"  value="'.$row['f_id'].'" name="edit">Edit</button>
                                <button class="btn btn-danger btn-sm" type="submit" value="'.$row['f_id'].'" name="delete">Delete</button>
                             </div>
                        </form>
                  </td>

                </tr>';
                }

                echo'</tbody>
                </table>
            </div>';



        }
        else{

           echo'<div class="alert alert-info mx-5" role="alert">
         No data to display !!.
         </div>';

        }

    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Something went wrong!</strong> .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }



?>



