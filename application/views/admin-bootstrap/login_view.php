<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $this->template->view('head'); ?>
    </head>

    <body>
        <div class="container" style="margin-top: 100px;width: 500px;">
            <div class="row">
                
                
                <div class="section section-padding corners" style="">
                    <?php echo form_open(admin_url('login/index'), 'id="loginform" name="loginform" class="form-horizontal"'); ?>                    
                    
                    <fieldset>
                        <legend>Giriş</legend>
                        <div class="control-group">
                        <label class="control-label form-lbl" for="email">E-Mail</label>
                        <div class="controls">
                            <input type="text" id="userlogin" class="input-xlarge"  placeholder="Email" name="email" maxlength="100" />
                        </div>
                    </div>   
                    <div class="control-group">
                        <label class="control-label form-lbl" for="parola">Parola</label>
                        <div class="controls">
                            <input type="password" id="userpass" class="input-xlarge"  placeholder="Parola" name="password" autocomplete="false" maxlength="20" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label form-lbl" for="remember_me"></label>
                        <div class="controls">
                            <label class="checkbox"><input type="checkbox" name="remember_me" value="evet" /> Beni Hatırla</label>
                            <a href="<?php echo site_url('kullanici/sifremi_unuttum'); ?>" class="">Şifremi Unuttum!</a>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" name="button" value="Giriş" id="save" class="btn btn-large btn-primary" />                        
                    </div>
                        
                    </fieldset>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <?php
        echo $js, $script;
        ?>
    </body>
</html>