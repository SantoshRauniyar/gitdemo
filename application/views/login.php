<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Haspatal Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fa5e54101c.js" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Theme Style -->
    <link rel="stylesheet" href="<?= base_url('assets/administrator/loginlib/style.css')?>">
                        <script>
                        
                        
                        
                        $(document).ready(function(){
         
                 
                                    
                                                 $('.show').click(function(){
                                                     
                                                    
                                                    
  var x = document.getElementById("x");
  if (x.type === "password") {
    x.type = "text";
    $('#msg').html('Hide Password');
  } else {
    x.type = "password";
     $('#msg').html('Show Password');
  }
                                                 });
                       
     })
        
    </script>
  </head>
  <body>
     <div class="col-12 hapt">
        <header>
            <div class="logo_container">
                <a class="">
                    <img src="<?= base_url('assets/administrator/loginlib/images/Logo.png')?>" />
                </a>
            </div>
         </header>
         <div class="row">
             <div class="col-md-9 jf">
                <div class="flx-box">
                    <div class="img_cont">
                        <img src="<?= base_url('assets/administrator/loginlib/images/dr.png')?>" />
                    </div>
                    <div class="ifc">
                        <div class="gg active">
                            <a class="" href="">
                                <span class=""><i class="fas fa-user-circle"></i></span>
                                login
                            </a>
                        </div>
                        <div class="gg">
                           <a class="" href="">
                               <span class=""><i class="fas fa-edit"></i></span>
                               Register
                           </a>
                       </div>
                       <div class="gg">
                           <a class="" href="">
                               <span class=""><i class="fas fa-lock"></i></span>
                               Forget&nbsp;Password
                           </a>
                       </div>
                    </div>
                    <?php $this->load->view('common/errors');?>
                    <form class="fie" method="post" action="<?php echo base_url('authentication/do_login');?>">
                  
                        <h6>Login</h6>
                         <fieldset>
									<div class="fl">
									    <span>e-mail</span>
	                                    <input class="form-control" placeholder="Email Address" name="email" type="email" value="<?php if(isset($email)){echo $email;}?>" autofocus>
	                                </div>
	                                <div class="fl">
	                                    <input class="form-control" placeholder="User Name" name="user_name" type="text" value="<?php if(isset($user_name)){echo $user_name;}?>">
	                                </div>
	                                <div class="fl">
	                                    <input class="form-control" id="x" placeholder="Password" name="password" type="password" value="<?php if(isset($user_password)){echo $user_password;}?>">
	                                </div>
	                                <div class="fl" style="display:inline;">
	                                    <label><input class="show" type="checkbox"><strong id="msg">Show Password</strong></label>
	                                    
	                                </div>
									<div class="fl">
	                                    <label>
	                                        <input name="remember" type="checkbox" <?php if(isset($user_name)){echo 'checked=checked';}?> >Remember Me
	                                    </label>
	                                </div>
                        <input type="submit" class="red_btn" value="Login">
                    
                  </form>
                </div>
             </div>
         </div>
     </div>
  </body>
</html>