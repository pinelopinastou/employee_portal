<?php require "../src/models/user.php";
require "../src/services/sessions_manager.php";

class SessionsController
{

    public $email, $password, $email_err, $password_err;

    //used in login.php
    function new ()
    {
        SessionsManager::check_if_session_is_active();
        $this->email = $this->password = "";
        $this->email_err = $this->password_err = "";
    }

    //used in login.php on POST action
    function create()
    {
        self::set_and_validate_params();

        if (empty($this->email_err) && empty($this->password_err))
        {
            $user = User::get_by_email($this->email);

            if (!$user)
            {
                $this->email_err = "Could not find email.";
            }
            elseif (!password_verify($this->password, $user['password']))
            {
                $this->password_err = "Password is incorrect.";
            }
            else
            {
                SessionsManager::create_session($user['ID'], $user['email'], $user['first_name'], $user['last_name']);
                $_SESSION["flash"] = ["type" => "success", "message" => "You have successfully logged in!"];
                if ($user['type'] == "employee")
                {
                    header("location: requests.php");
                }
                else
                {
                    header("location: user_management.php");
                }
            }
        }
    }
    //used in logout.php
    function destroy()
    {
        SessionsManager::destroy_session();
        header("location:../public/login.php");
    }

    //set and validate post params
    private function set_and_validate_params()
    {
        if (empty(trim($_POST["email"])))
        {
            $this->email_err = "Please enter email.";
        }
        else
        {
            $this->email = trim($_POST["email"]);
        }

        if (empty(trim($_POST["password"])))
        {
            $this->password_err = "Please enter your password.";
        }
        else
        {
            $this->password = trim($_POST["password"]);
        }
    }

}
?>
