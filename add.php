    if ($do == 'add') {
    ?>
       
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col sm-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Add New Users</h3>
                    <ul class="list-inline two-part">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="exampleInputusername" class="form-label">User Name*</label>
                                        <input name="user_name" type="text" class="form-control" id="exampleInputusername">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">User Email*</label>
                                        <input name="user_email" type="email" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password*</label>
                                        <input name="user_pass" type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputaddress" class="form-label">Address</label>
                                        <input name="user_address" type="text" class="form-control" id="exampleInputaddress">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-tel-input" class="col-2 col-form-label">Phone</label>
                                        <div class="col-12">
                                            <input name="user_phone" class="form-control" type="tel" id="example-tel-input">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="col-2 col-form-label">Date</label>
                                        <div class="col-12">
                                            <input name="user_date" class="form-control" type="date" id="example-date-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-lg-6">
                                    <div class="mb-3">
                                        <label for="exampleSelect1">Select Gender</label>
                                        <select name="user_gender" class="form-select" aria-label="Default select example1">
                                            <option selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleSelect2">Select Role</label>
                                        <select name="user_role" class="form-select" aria-label="Default select example2">
                                            <option selected>Select Status</option>
                                            <option value="0">Subscriber</option>
                                            <option value="1">Editor</option>
                                            <option value="2">Admin</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleSelect3">Select Status</label>
                                        <select name="user_status" class="form-select" aria-label="Default select example3">
                                            <option selected>Select Status</option>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleBiodata">Biodata</label>
                                        <textarea name="user_bio" class="form-control" id="exampleBiodata" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleEducation">Education</label>
                                        <textarea name="user_edu" class="form-control" id="exampleEducation" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputFilepho">Photo Upload*</label>
                                        <input name="user_image" type="file" class="form-control-file" id="exampleInputFilepho" aria-describedby="fileHelp">
                                        <br>
                                        <small id="fileHelp" class="form-text text-muted">Select Photo Only, Don't upload photo more than 1mb. upload jpg png jpeg format only</small>
                                    </div>
                                    <button name="user_submit" type="submit" class="btn btn-primary fs-5">Add New User</button>
                                </div>
                            </div>
                        </form>


                        <?php

                        if (isset($_POST['user_submit'])) {
                            $user_name = $_POST['user_name'];
                            $user_email = $_POST['user_email'];
                            $user_pass = $_POST['user_pass'];
                            $user_address = $_POST['user_address'];
                            $user_phone = $_POST['user_phone'];
                            $user_date = $_POST['user_date'];
                            $user_gender = $_POST['user_gender'];
                            $user_role = $_POST['user_role'];
                            $user_status = $_POST['user_status'];
                            $user_bio = $_POST['user_bio'];
                            $user_edu = $_POST['user_edu'];
                            $user_image = $_FILES['user_image']['name'];
                            $temp_image = $_FILES['user_image']['temp_image'];

                            $add_users_sql = "INSERT INTO users (u_name,u_image,u_email,u_password,u_address,u_phone,u_dob,u_gender,u_bio,u_education,u_role,u_status) VALUES ('$user_name','','$user_email','$user_pass','$user_address','$user_phone','$user_date','$user_gender','$user_bio','$user_edu','$user_role','$user_status')";

                            $users_sql_db = mysqli_query($db, $add_users_sql);

                            if ($users_sql_db) {
                                header('Location: users.php');
                            } else {
                                echo "INPUT Users details failed";
                            }



                            if (!empty($user_name)) {

                                $explode = explode('.', $_FILES['user_image']['name']);

                                $end = strtolower(end($explode));

                                $array = array('jpg', 'png', 'jpeg');


                                if (in_array($end, $array) === true) {

                                    $random = rand();
                                    $update_img = $random . $user_image;

                                    move_uploaded_file($temp_image, 'img/users/' . $update_name);

                                    $encrypt_password = sha1($user_pass);

                                    $addusers = "INSERT INTO users (u_name,u_image,u_email,u_password,u_address,u_phone,u_dob,u_gender,u_bio,u_education,u_role,u_status) VALUES ('$user_name','$update_img','$user_email','$user_pass','$user_address','$user_phone','$user_date','$user_gender','$user_bio','$user_edu','$user_role','$user_status')";

                                    $addusersdb = mysqli_query($db, $addusers);

                                    if ($addusersdb) {
                                        header('Location: users.php');
                                    } else {
                                        echo "INPUT Users details failed";
                                    }
                                } else {
                                    echo "file name format error! This is not an image";
                                }
                            } else {
                                echo "<span class='badge bg-danger fw-bold fs-7'>PLEASE Input all required information like name email phone and photo</span>";
                            }
                        }


                        ?>

                    </ul>
                </div>
            </div>
        </div>




    <?php
    }
