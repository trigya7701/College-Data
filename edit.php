<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

<?php

include'connect.php';




$updateId=$_GET['id'];

$nameError="";
$phoneError="";
$ageError="";
$subjectError="";

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update'])){

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

            $editDataSql="UPDATE `faculty` SET `f_name`='$name',`f_age`='$age',`f_phone`='$phone',`f_subject`='$subject' WHERE `f_id`=$updateId";
            $editDataResult=mysqli_query($conn,$editDataSql);

            if($editDataResult){

               


              header('Location: index.php ');
               exit;

            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Something went wrong!</strong> Could not update data .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }

        }

}

$getDataSql="SELECT * FROM `faculty` WHERE `f_id`=$updateId";
$getDataResult=mysqli_query($conn,$getDataSql);

if($getDataResult){

    $row=mysqli_fetch_assoc($getDataResult);

    echo'<form action="" method="POST" class="px-5">
            <div class="row mb-3 mt-4">
                <label for="recipent-name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="recipient-name" value="'.$row['f_name'].'" name="fname" required>
                    <p style="color:red">'.$nameError.'</p>
                </div>
            </div>

            <div class="row mb-3 mt-4">
                <label for="recipent-age" class="col-sm-2 col-form-label">Age</label>
                <div class="col-sm-10">
                <input type="number" class="form-control" id="recipient-age" value="'.$row['f_age'].'" name="age" required>
                <p style="color:red">'.$ageError.'</p>
                </div>
            </div>

            <div class="row mb-3 mt-4">
                <label for="recipent-phone" class="col-sm-2 col-form-label">Phone Number</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="recipient-phone" value="'.$row['f_phone'].'" name="phone" required>
                    <p style="color:red">'.$phoneError.'</p>
                </div>
            </div>

            <div class="row mb-3 mt-4">
                <label for="recipent-subject" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="recipient-subject" value="'.$row['f_subject'].'" name="subject" required>
                <p style="color:red">'.$subjectError.'</p>
                </div>
            </div>
        
        <button type="submit" class="btn btn-warning" name="update">Update</button>
     </form>
    ';


}
else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Something went wrong!</strong> .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
}


?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>