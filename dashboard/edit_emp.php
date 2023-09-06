<?php include("header.php");
include("Configuration.php");
if ($role != 0) {
  header("location:../404.php");
}
$emp_id = $_GET['id'];
if (empty($emp_id)) {
  header("location:users_list.php");
}
$sql = "SELECT * FROM user_reg_tbl WHERE emp_id='$emp_id'";
$query = mysqli_query($config, $sql);
$row = mysqli_fetch_assoc($query);
if (isset($_POST['update_emp'])) {
  $u_name = mysqli_real_escape_string($config, $_POST['user_name']);
  $u_des = mysqli_real_escape_string($config, $_POST['user_des']);
  $u_sec = mysqli_real_escape_string($config, $_POST['user_section']);
  $u_res = mysqli_real_escape_string($config, $_POST['user_res']);
  $u_scale = mysqli_real_escape_string($config, $_POST['user_scale']);
  $u_role = mysqli_real_escape_string($config, $_POST['user_role']);
  if (strlen($u_name) < 4 || strlen($u_name) > 100) {
    $error = "<span class='text-danger'>Username must be between 4 to 100 char";
  } else {
    $sql2 = "UPDATE user_reg_tbl SET user_name='$u_name',user_des='$u_des',user_section='$u_sec',user_res='$u_res',user_scale='$u_scale',user_role='$u_role' WHERE emp_id='$emp_id'";
    $query2 = mysqli_query($config, $sql2);
    if ($query2) {
      $_SESSION['msg'] = "<span class='text-success text-center'>One record has been updated successfully</span>";
      header("location:edit_emp.php");
    } else {
      $error = "<span class='text-danger'>Failed,please try again</span>";
    }
  }
}
?>
<div class="container mt-2">
  <form action="" method="POST">
    <div class="row m-2 p-4 register_form border border-secondary">
      <h5 class="text-center">Edit Employee Information</h5>
      <div class="col-md-5 m-auto">
        <div class="mb-2">
          <label>Fullname</label>
          <input type="text" name="user_name" placeholder="Fullname" class="form-control" required value="<?= $row['user_name'] ?>" maxlength="30" minlength="3">
        </div>
        <div class="mb-2">
          <label>Designation</label>
          <input type="text" name="user_des" placeholder="Designation" class="form-control" required value="<?= $row['user_des'] ?>" maxlength="30" minlength="3">
        </div>
        <div class="mb-2">
          <label>State</label>
          <select class="form-control required" name="user_section">
            <option value="<?= $row['user_section'] ?>" selected><?= $row['user_section'] ?></option>
            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
            <option value="Andhra Pradesh">Andhra Pradesh</option>
            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
            <option value="Assam">Assam</option>
            <option value="Bihar">Bihar</option>
            <option value="Chandigarh">Chandigarh</option>
            <option value="Chhattisgarh">Chhattisgarh</option>
            <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
            <option value="Daman and Diu">Daman and Diu</option>
            <option value="Delhi">Delhi</option>
            <option value="Goa">Goa</option>
            <option value="Gujarat">Gujarat</option>
            <option value="Haryana">Haryana</option>
            <option value="Himachal Pradesh">Himachal Pradesh</option>
            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
            <option value="Jharkhand">Jharkhand</option>
            <option value="Karnataka">Karnataka</option>
            <option value="Kerala">Kerala</option>
            <option value="Lakshadweep">Lakshadweep</option>
            <option value="Madhya Pradesh">Madhya Pradesh</option>
            <option value="Maharashtra">Maharashtra</option>
            <option value="Manipur">Manipur</option>
            <option value="Meghalaya">Meghalaya</option>
            <option value="Mizoram">Mizoram</option>
            <option value="Nagaland">Nagaland</option>
            <option value="Odisha">Odisha</option>
            <option value="Puducherry">Puducherry</option>
            <option value="Punjab">Punjab</option>
            <option value="Rajasthan">Rajasthan</option>
            <option value="Sikkim">Sikkim</option>
            <option value="Tamil Nadu">Tamil Nadu</option>
            <option value="Telangana">Telangana</option>
            <option value="Tripura">Tripura</option>
            <option value="Uttar Pradesh">Uttar Pradesh</option>
            <option value="Uttarakhand">Uttarakhand</option>
            <option value="West Bengal">West Bengal</option>
          </select>
        </div>
        <div class="mb-2">
          <label>Responsibilities</label>
          <textarea class="form-control" rows="3" name="user_res" maxlength="300" minlength="10"><?= $row['user_res'] ?>
              </textarea>
        </div>
      </div>
      <div class="col-md-5 m-auto">
        <div class="mb-2">
          <label>Employee PayScale</label>
          <select class="form-control required" name="user_scale">
            <option value="<?= $row['user_scale'] ?>" selected><?= $row['user_scale'] ?></option>
            <option value="EPS-0">EPS-0</option>
            <option value="EPS-1">EPS-1</option>
            <option value="EPS-2">EPS-2</option>
            <option value="EPS-3">EPS-3</option>
            <option value="EPS-4">EPS-4</option>
            <option value="EPS-5">EPS-5</option>
            <option value="EPS-6">EPS-6</option>
            <option value="EPS-7">EPS-7</option>
            <option value="EPS-8">EPS-8</option>
            <option value="EPS-9">EPS-9</option>
            <option value="EPS-10">EPS-10</option>
          </select>
        </div>
        <div class="mb-2">
          <label>User ID</label>
          <input disabled type="text" name="user_id" class="form-control" value="<?= $row['user_id'] ?>" maxlength="30" minlength="4">
        </div>
        <div class="mb-2">
          <label>Password</label>
          <input disabled type="password" name="user_pass" class="form-control" value="">
        </div>
        <div class="mb-2">
          <label>User Role</label>
          <select required name="user_role" class="form-control">
            <option selected value="<?= $row['user_role'] ?>"><?php if ($row['user_role'] == 0) {
                                                                echo "Admin";
                                                              } else {
                                                                echo "Normal User";
                                                              }
                                                              ?></option>
            <option value="1">Normal User</option>
            <option value="0">Admin</option>
          </select>
        </div>
        <div class="mb-2">
          <button class="btn btn-primary" name="update_emp">Update</button>
          <a href="users_list.php" class="btn btn-secondary">Back</a>
        </div>
      </div>
    </div>
  </form>
</div>
<?php include("footer.php"); ?>