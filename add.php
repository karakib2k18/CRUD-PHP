    if ($do == 'add') {
    ?>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col sm-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Add New Category</h3>
                    <ul class="list-inline two-part">
                        <form method="POST">
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

                                        <label for="exampleSelect1">Select Your Gender</label>
                                        <select class="form-control" id="exampleSelect1" name="user_gender">
                                            <option> Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleSelect2">Select Role</label>
                                        <select name="user_role" class="form-select" id="exampleSelect2">
                                            <option>Select Role</option>
                                            <option value="0">Subscriber</option>
                                            <option value="1">Editor</option>
                                            <option value="2">Admin</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleSelect3">Select Status</label>
                                        <select name="user_status" class="form-select" id="exampleSelect3">
                                            <option>Select Status</option>
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

                        <!-- category code inserted here -->
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


                            if (!empty($user_name)) {

                                $split = explode('.', $_FILES['user_image']['name']);

                                $extn = strtolower(end($split));

                                $array1 = array('jpg', 'png', 'jpeg');


                                if (in_array($extn, $array1) === true) {

                                    $random = rand();
                                    $update_img = $random.$user_image;

                                    move_uploaded_file($temp_image, 'img/users/'.$update_img);

                                    $encrypt_password = sha1($user_pass);


                                    //3 steps //sql //sql>database //feedback


                                    $user_sql = "INSERT INTO user (u_name,u_image,u_email,u_password,u_address,u_phone,u_dob,u_gender,u_bio,u_education,u_role,u_status) VALUES ('$user_name','$update_img', '$user_email','$user_pass', '$user_address','$user_phone', '$user_date', '$user_gender', 'user_bio', '$user_edu', '$user_role','$user_status')";

                                    
                                    //('$user_name','', '$user_email','$user_pass', '$user_address', 0, 0, 0,  'user_bio', '$user_edu', 0, 0)
                                    

                                    $user_result = mysqli_query($db, $user_sql);

                                    if ($user_result) {
                                        header('Location: users.php');
                                    } else {
                                        echo "catagory insert Error";
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
