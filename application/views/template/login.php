<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?=base_url()?>assets/img/logo-fav.png">
    <title>BCET</title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" type="text/css"/>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container" style="margin: 10px auto;">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading"><img src="<?=base_url()?>home_assets/images/bcetlogo.png" alt="logo" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
              <div class="panel-body">
                <?=$this->parser->parse('template/alert',[],TRUE);?>
               <?=form_open(base_url('auth/login'))?>
                  <div class="login-form">
                    
                    <div class="form-group">
                      <input id="username" name="username" type="text" placeholder="Username" autocomplete="off" class="form-control">
                    </div>
                    <div class="form-group">
                      <input id="password" name="password" type="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group row login-tools">
                      <div class="col-xs-6 login-remember">
                        <div class="be-checkbox">
                          <input type="checkbox" name="remember"  id="remember">
                          <label for="remember">Remember Me</label>
                        </div>
                      </div>
                      <div class="col-xs-6 login-forgot-password"><a href="<?=base_url()?>">Forgot Password?</a></div>
                    </div>
                    <div class="form-group row login-submit">
                      <div class="col-xs-12">
                        <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Log in</button>

                        <div style="margin-bottom:15px;"></div>
                        <a href="http://bcetorissa.org" class="btn btn-xl" style="background-color: #55cbf9;color: white;">Back to website</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?=base_url()?>assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/js/main.js" type="text/javascript"></script>
    <script src="<?=base_url()?>assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });
      
    </script>
  </body>
</html>