<?php require_once("header.php");?>
<body>  
  <div class="container-wrapper">
    <div class="container">
      <div class="col-md-6 mx-auto">
        <div class="alert alert-danger" role="alert">
                Login is failed!
        </div>
        <div class="alert alert-success" role="alert">
                Login is success! Confirm email adress.
        </div>
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="loginEmail" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="loginPass" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary" id="submitLogin">Submit</button>
        </form>
        <div class="col-md-12 mt-4 pr-0 text-right">
            <a href="register.php">Already haven't yet account?</a>
          </div>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/js/index.js"></script>
</body>

</html>