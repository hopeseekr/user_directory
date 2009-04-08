<?php
/************************************
 * User Directory Live Tutorial
 *
 * Copyright(c) 2008 Theodore R. Smith
 * License: Creative Commons */

?>
        <div id="profile">
<?php
    if (isset($_SESSION['userInfo']))
    {
        $username = $_SESSION['userInfo']->username;
        $firstName = $_SESSION['userInfo']->firstName;
        $lastName = $_SESSION['userInfo']->lastName;
        $email = $_SESSION['userInfo']->email;
    }

    $registration_potentials = array(MY_USER_REGISTERED => 'Successfully registered.',
                                     MY_USER_PROFILE_UPDATED => 'Profile successfully updated.', 
                                     MYE_USER_BLANK_PASS => 'Error: No password was entered.',
                                     MYE_USER_EXISTS => 'Error: Username exists. Please try again.',
                                     MYE_USER_PASS_NOMATCH => 'Error: The passwords do not match.');


    if ($registration_status != '')
    {
?>
            <h3><?php echo $registration_potentials[$registration_status]; ?></h3>
<?php
    }
?>
            <form method="post" class="classyform" action="?action=<?php echo isset($action) && $action == 'edit_profile' ? $action : 'register'; ?>">
                <fieldset>
                    <legend><?php echo isset($action) && $action == 'edit_profile' ? 'Edit Profile' : 'Register'; ?></legend>
                    <ul>
                        <li>
                            <label for="register_username" accesskey="u">Username:</label>
                            <input type="text" name="username" id="register_username" value="<?php echo $username; ?>"<?php echo isset($action) && $action == 'edit_profile' ? ' readonly="readonly"' : ''; ?>/>
                        </li>
                        <li>
                            <label for="register_password" accesskey="p">Password:</label>
                            <input type="password" name="password" id="register_password"/>
                        </li>
                        <li>
                            <label for="confirm" accesskey="c">Confirm:</label>
                            <input type="password" name="confirm" id="confirm"/>
                        </li>
                        <li>
                            <label for="firstname" accesskey="f">First name:</label>
                            <input type="text" name="firstName" id="firstname" value="<?php echo $firstName; ?>"/>
                        </li>
                        <li>
                            <label for="lastname" accesskey="l">Last name:</label>
                            <input type="text" name="lastName" id="lastname" value="<?php echo $lastName; ?>"/>
                        </li>
                        <li>
                            <label for="email" accesskey="e">Email:</label>
                            <input type="text" name="email" id="email" value="<?php echo $email; ?>"/>
                        </li>
                        <li>
                            <label>&nbsp;</label>
                            <input type="submit" name="profile" value="Submit"/>
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>