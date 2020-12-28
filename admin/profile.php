<?php require_once('header.php');?>
            

<div class="row mt-sm-4">
  <div class="col-12 col-md-12 col-lg-4">
    <div class="card author-box">

      <div class="card-body">
        <div class="author-box-center">
          <img alt="image" src="assets/img/users/user-1.png" class="rounded-circle author-box-picture">
          <div class="clearfix"></div>
          <div class="author-box-name">
            <a href="#">Sarah Smith</a>
          </div>
          <div class="author-box-job">Web Developer</div>
        </div>
      </div>

    </div>
  </div>


  <div class="col-12 col-md-12 col-lg-8">
    <div class="card">
      <div class="padding-20">
        <ul class="nav nav-tabs" id="myTab2" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
              aria-selected="true">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
              aria-selected="false">Change password</a>
          </li>
        </ul>
        <div class="tab-content tab-bordered" id="myTab3Content">

          <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
            <form>
            <div class="row">
                <div class="form-group col-md-12">
                      <label>Name</label>
                      <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                      <label>Username</label>
                      <input type="text" class="form-control" name="user_name">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Photo</label>
                    <div class="custom-file">
                        <input type="file" name="profile_photo" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="update_profile" class="btn btn-primary">Profile Update</button>
              </div>
             </form>
          </div>

          <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
            <form method="post" class="needs-validation" action=" "> 
              <div class="card-header">
                <h4>Change Password</h4>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-7 col-lg-6">
                      <label>Current Password</label>
                      <input type="password" class="form-control" name="current_password">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-7 col-lg-6">
                      <label>New Password</label>
                      <input type="password" class="form-control" name="new_password">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-7 col-lg-6">
                      <label>New Password Confirme</label>
                      <input type="password" class="form-control" name="new_password_confirme">
                    </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="password_change" class="btn btn-primary">Change Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php require_once('footer.php');?>