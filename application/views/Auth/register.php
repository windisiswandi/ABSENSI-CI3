<body class="login">
    <div>
      <div class="login_wrapper">
        <div id="signup">
            <section class="login_content">
            <form method="post">
                <h1>Create Account</h1>
                <div>
                    <input type="text" class="form-control" value="<?= set_value("username"); ?>" name="username" placeholder="Username" />
                    <?= form_error('username'); ?>
                </div>
                <div>
                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?= set_value("email"); ?>" />
                    <?= form_error("email"); ?>
                </div>
                <div>
                    <input type="password" class="form-control" name="password" placeholder="Password" />
                    <?= form_error("password"); ?>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <input type="submit" name="register" class="btn btn-primary" value="register">
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="separator">
                <p class="change_link">Already a member ?
                    <a href="<?= base_url('Auth/login'); ?>" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
                </div>
            </form>
            </section>
        </div>
        
        </div>
    </div>