<div class="container my-3 mx-5"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
    data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add Data</button>
</div>

<?php


        include 'connect.php';

        $nameError="";
        $phoneError="";
        $ageError="";
        $subjectError="";

    
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){

        $name=$_POST['fname'];
        $age=$_POST['age'];
        $phone=$_POST['phone'];
        $subject=$_POST['subject'];

        if(empty($name)){

            $nameError=" * Name cannot be empty";
        }

        if($age<18 || $age>100 || empty($age) ){
            $ageError=" * Please enter a valid age";
        }

        if(empty($phone) || !preg_match('/^[6-9]\d{9}$/',$phone)){
            $phoneError=" * Please enter a valid phone number";
        }

        if(empty($subject)){

            $subjectError="* Subject cannot be empty";
        }


        if($nameError==""  && $ageError=="" && $phoneError=="" && $subjectError==""){

            $addDataSql="INSERT INTO `faculty`( `f_name`, `f_age`, `f_phone`, `f_subject`) 
            VALUES ('$name','$age','$phone','$subject')";
            $addDataResult=mysqli_query($conn,$addDataSql);

            if($addDataResult){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>Data submitted.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Something went wrong.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
            
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Invalid!</strong> Please enter valid data.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }



       
    }

?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Full Name</label>
                        <input type="text" class="form-control" name="fname" id="recipient-name" required>
                        
                    </div>

                    <div class="mb-3">
                        <label for="recipient-age" class="col-form-label">Age</label>
                        <input type="number" class="form-control" name="age" id="recipient-age" required>
                        
                    </div>

                    <div class="mb-3">
                        <label for="recipient-phone" class="col-form-label">Phone No.</label>
                        <input type="number" class="form-control" name="phone" id="recipient-phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-subject" class="col-form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" id="recipient-subject" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

