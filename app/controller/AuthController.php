<?php

require_once "../app/helper.php";
model_asset("User");

class AuthController
{
    public function login($request)
    {
        $user = new User();
        $credentials = [
            "email" => $request["email"],
            "password" => $request["password"],
        ];

        if ($user->login($credentials)["success"]) {
            $_SESSION["login"] = [
                "id" => $user->login($credentials)["user"]["id"],
                "name" => $user->login($credentials)["user"]["name"],
            ];
            redirect("dashboard/index.php");
            exit;
        } else {
            setNotification("Login Gagal", "Email atau Password Salah", "error");
            redirect("auth/login.php");
            exit;
        }
    }

    public function register($request)
    {
        $user = new User();
        $credentials = [
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => $request["password"],
            "role" => "admin",
        ];

        try {
            $user->register($credentials);
            setNotification("Berhasil", "Akun Berhasil dibuat, silahkan login", "success");
            redirect("dashboard/index.php");
            exit;
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
            redirect("auth/register.php");
            exit;
        }
    }

    public function changePassword($request)
    {
        try {
            $id = $_SESSION["login"]["id"];
            $oldPassword = $request["old_password"];
            $newPassword = $request["new_password"];
            $confirmPassword = $request["confirm_password"];

            $searchedUser = User::find($id);

            if (!password_verify($oldPassword, $searchedUser["password"])) {
                throw new Exception("Password Lama Salah");
            }

            if ($newPassword != $confirmPassword) {
                throw new Exception("Konfirmasi password tidak sama");
            }

            $user = new User();
            $user->changePassword($id, $newPassword);

            setNotification("Berhasil", "Password berhasil diubah, silahkan login kembali", "success");
            $this->logout();
        } catch (Exception $e) {
            setNotification("Gagal", $e->getMessage(), "error");
            redirect("auth/change-password.php");
            exit;
        }
    }

    public function logout()
    {
        User::logout();
        redirect("auth/login.php");
        exit;
    }
}
