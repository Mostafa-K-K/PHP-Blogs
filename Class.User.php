<?php

class USER
{
    private $db;

    public function USER($DB_con)
    {
        $this->db = $DB_con;
    }

    public function register($username, $email, $password)
    {
        try
        {
            $stmt = $this->db->prepare("INSERT INTO Users(username, email, password)
                                                    VALUES(:username, :email, :password)");
            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":password", $password);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function login($username, $password)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM Users WHERE username=? AND password=? OR email=? AND password=?");
            $stmt->execute([$username, $password, $username, $password]);
            $isUser = $stmt->fetch(PDO::FETCH_ASSOC);
            $userID = $isUser['userID'];
            if ($isUser > 0) {
                setcookie('userID', $userID, time() + (86400 * 30), "/");
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if (isset($_COOKIE['userID'])) {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        setcookie('userID', '', time() - 3600, '/');
        return true;
    }
}
