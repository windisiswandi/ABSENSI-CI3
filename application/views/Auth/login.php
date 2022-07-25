<body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate login_form">
          <section class="login_content">
            <form method="post">
              <img src="<?= base_url("assets/images/semka.png"); ?>" alt="semka.png" width="130" class="mb-3">
              <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus/>
                <?php if(@$error["username"]) : ?>
                  <p style="color: red;">Username not found</p>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                <?php if(@$error["password"]) : ?>
                  <p style="color: red;">Password is wrong</p>
                <?php endif; ?>
              </div>
              <div class="text-center">
                <input type="submit"  class="btn btn-primary" name="login" value="Log In">
              </div>              
            </form>
          </section>
        </div>        
      </div>
    </div>
  
    