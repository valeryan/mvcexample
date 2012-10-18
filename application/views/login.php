        <form id="login"  action="<?php echo $method ?>" method="post" name="pwd">
            <h1>Log In</h1>
            <?php if (!empty($error)){
            echo '<span style="color:red;">' .$error. '</span>';
            } ?>
            <fieldset id="inputs">
                <input name="user" id="username" type="text" placeholder="Username" autofocus required />
                <input name="passwd" id="password" type="password" placeholder="Password" required />
            </fieldset>
            <fieldset id="actions">
                <input type="submit" name="submit_pwd" value="Login"/>
            </fieldset>
        </form>