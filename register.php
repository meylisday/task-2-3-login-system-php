<?php require_once("header.php"); ?>
<body>
    <div class="container-wrapper">
      <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="alert alert-danger" role="alert">
                Register is failed!
            </div>
            <div class="alert alert-success" role="alert">
                Register is success!
            </div>
          <form>
          <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" id="registerUsername" placeholder="Enter username">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="registerEmail" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="registerPass" placeholder="Password">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Confirm password</label>
              <input type="password" class="form-control" id="registerPass2" placeholder="Confirm password">
            </div>
            <button type="submit" class="btn btn-primary" id="submitForm">Submit</button>
          </form>
          <div class="col-md-12 mt-4 pr-0 text-right">
            <a href="index.php">Already yet account?</a>
          </div>
        </div>
      </div>
    </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/js/index.js"></script>
  </body>
  </html>