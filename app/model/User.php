<?php

require_once "../config/database.php";

class User
{
    public static function find($id)
    {
        $conn = new Database();
        $result = $conn->query("SELECT * FROM users WHERE id = $id");
        return $result->fetch_assoc();
    }

    public function changePassword($id, $newPassword): bool|mysqli_result
    {
        $password = password_hash($newPassword, PASSWORD_DEFAULT);

        $conn = new Database();
        return $conn->query("UPDATE users SET password = '$password' WHERE id = $id");
    }

    public function login($credentials)
    {
        $email = $credentials["email"];
        $password = $credentials["password"];

        $conn = new Database();
        $result =  $conn->query("SELECT * FROM users WHERE email = '$email'");
        $row = $result->fetch_assoc();
        return [
            "success" => password_verify($password, $row["password"]),
            "user" => $row
        ];
    }

    public function register($credentials)
    {
        $name = $credentials["name"];
        $email = $credentials["email"];
        $password = password_hash($credentials["password"], PASSWORD_DEFAULT);
        $role = $credentials["role"];

        $conn = new Database();
        return $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
    }

    public static function logout()
    {
        unset($_SESSION["login"]);
    }
}
