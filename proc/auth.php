<?php
class auth{

    // method to bind email template variables
    private function bindEmailVars($template, $variables) {
        foreach ($variables as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }
        return $template;
    }

    public function signup($conf, $ObjFncs, $lang, $ObjSendMail) {
        // signup logic here
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {

            // initialize an array to hold errors
            $errors = [];

            // process signup
            $fullname = $_SESSION['fullname'] = ucwords(strtolower($_POST['fullname']));
            $email = $_SESSION['email'] = strtolower($_POST['email']);
            $password = $_SESSION['password'] = $_POST['password']; // In real applications, hash the password before storing

            // Some validation before storing to database (not implemented here)

            if(empty($fullname) || empty($email) || empty($password)) {
                $errors['empty_fields'] = "All fields are required.";
            }

            // Only allow letters, spaces, and hyphens in fullname
            if(!preg_match("/^[a-zA-Z-' ]*$/", $fullname)) {
                $errors['nameFormat_error'] = "Only letters and white space allowed in fullname.";
            }

            // Validate email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['emailFormat_error'] = "Invalid email format.";
            }

            // Check for valid domain
            $email_domain = substr(strrchr($email, "@"), 1);
            if(!in_array($email_domain, $conf['valid_email_domains'])) {
                $errors['emailDomain_error'] = "Email domain must be one of the following: " . implode(", ", $conf['valid_email_domains']) . ".";
            }

            // Validate password (minimum 6 characters)
            if(strlen($password) < $conf['min_password_length']) {
                $errors['passwordLength_error'] = "Password must be at least " . $conf['min_password_length'] . " characters long.";
            }

            if(!count($errors)) {
                // die($fullname . " " . $email . " " . $password);

                // Send verification email
                $EmailVariables = [
                    'site_name' => $conf['site_name'],
                    'fullname' => $fullname,
                    'activation_code' => rand(100000, 999999), // In real applications, generate a secure activation code
                    'mail_from_name' => $conf['mail_from_name']
                ];

                $mailCnt = [
                    'name_from' => $conf['mail_from_name'],
                    'mail_from' => $conf['mail_from'],
                    'name_to' => $fullname,
                    'mail_to' => $email,
                    'subject' => $this->bindEmailVars($lang['reg_ver_subject'], $EmailVariables),
                    'body' => nl2br($this->bindEmailVars($lang['reg_ver_body'], $EmailVariables))
                ];

                 $ObjSendMail->Send_Mail($conf, $mailCnt); // send the email

                // Clear session data after successful signup
                unset($_SESSION['fullname']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                $ObjFncs->setMsg('msg', 'Signup successful! Please check your email for verification.', 'success');
            } else {
                $ObjFncs->setMsg('errors', $errors, 'danger');
                $ObjFncs->setMsg('msg', 'Please correct the errors and try again.', 'warning');
            }
        }
    }
    public function signin() {
        echo "This is the signin page.";
    }
}