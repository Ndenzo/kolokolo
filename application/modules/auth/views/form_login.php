<!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset mt-login-5-bsfix">
            <div class="login-bg">
                <img class="login-logo" src="<?php _url();?>assets/pages/img/april.png" /> </div>
        </div>
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="login-content">
                <h1 class="sbold">Bienvenue sur <span class="sbold uppercase">April Suite </span></h1>
                <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing.
                </p>
                <form class="login-form" action="<?php _url("auth/login");?>" method="post">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Erreur lors de la connexion. Vérifiez vos identifiants et mots de passe. </span>
                    </div>
                    <?php
                    $message = $this->session->flashdata('message');
                    if(!empty($message)):?>
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <?php echo $message;?>
                        </div>
                    <?php endif;?>
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Nom d'utilisateur" name="username" required/> </div>
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Mot de passe" name="password" required/> </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password hide">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input name="remember" value="1" type="checkbox"> Remember me
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="forgot-password hide">
                                <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                            </div>
                            <button class="btn green" type="submit">Se connecter</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact" style="padding:12px 0px; margin:36px auto 0px auto; border-top: 1px solid #d4d4d4; background: #ff9900 ">
                                <ul >
                                    <li><a class="top-phone font-white"><i class="fa fa-phone"></i> +221 33 864 27 00</a></li>
                                    <li><a href="mailto:chil.lapierre@april-africa.com" class="font-white"><i class="fa fa-envelope-o"></i> contact@april-africa.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-md-5 col-xs-3 col-sm-3  bs-reset">
                        <ul class="login-social pull-left">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-7 col-sm-9 col-xs-9  bs-reset">
                        <div class="login-copyright pull-right">
                            Copyright &copy; <a href="#">Ibems Creative</a> 2017
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>