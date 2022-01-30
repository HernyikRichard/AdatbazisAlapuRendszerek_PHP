<?php

class User
{
    private $fname;
    private $email;
    private $admin;

    /**
     * User constructor.
     * @param $fname
     * @param $email
     * @param $hely
     */
    public function __construct($fname, $email, $admin){
        $this->fname = $fname;
        $this->email = $email;
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getFname()
    {
        return $this->fname;
    }

    /**
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->fname = $fname;
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
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }


}