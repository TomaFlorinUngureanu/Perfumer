<?php
class mailFunctionality
{
    private $name;
    private $email;
    private $subject;
    private $message;
    private $name_error;
    private $subject_error;
    private $email_error;
    private $message_error;
    private $config;

    /**
     * mailFunctionality constructor.
     */
    public function __construct()
    {
        $this->config = parse_ini_file('..\..\config\emailConfig.ini', true);
    }

    /**
     * @return mixed
     */
    public function getNameError()
    {
        return $this->name_error;
    }

    /**
     * @return mixed
     */
    public function getSubjectError()
    {
        return $this->subject_error;
    }

    /**
     * @return mixed
     */
    public function getEmailError()
    {
        return $this->email_error;
    }

    /**
     * @return mixed
     */
    public function getMessageError()
    {
        return $this->message_error;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }


    public function setFields()
    {
        if (isset($_POST['submit']))
        {
            $this->setName(htmlspecialchars(stripslashes(trim($_POST['name']))));
            $this->setSubject(htmlspecialchars(stripslashes(trim($_POST['subject']))));
            $this->setEmail(htmlspecialchars(stripslashes(trim($_POST['email']))));
            $this->setMessage(htmlspecialchars(stripslashes(trim($_POST['message']))));
            if (!preg_match("/^[A-Za-z .'-]+$/", $this->getName()))
            {
                $this->name_error = 'Invalid name';
            }

            if (!preg_match("/^[A-Za-z .'-]+$/", $this->getSubject()))
            {
                $this->subject_error = 'Invalid subject';
            }
            if (!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $this->getEmail()))
            {
                $this->email_error = 'Invalid email';
            }
            if (strlen($this->getMessage()) === 0)
            {
                $this->message_error = 'Your message should not be empty';
            }
        }
    }

    public function sendFeedback()
    {
        if (isset($_POST['submit']) && !isset($name_error) && !isset($subject_error) && !isset($email_error) && !isset($message_error))
        {
            try
            {
                $mail = new PHPMailer(); // create a new object
                $mail->IsSMTP(); // enable SMTP
                $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = $this->config['email']['username'];
                $mail->Password = $this->config['email']['password'];
                $mail->SetFrom($this->getEmail(), $this->getName());
                $mail->AddAddress($mail->Username);
                $mail->Subject = $this->getSubject();
                $mail->Body = $this->getMessage();

                if (!$mail->send())
                {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else
                {
                    echo "Message has been sent successfully";
                    header( "refresh:1;url=PerfumerIndex.php" );

                }
            } catch
            (\phpmailerException $excp)
            {
                echo $excp->getMessage();
            }
        }
        $_POST = array();
    }
}