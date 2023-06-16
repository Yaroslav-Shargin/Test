<?php

use PHPUnit\Framework\TestCase;

class ChangePasswordTest extends TestCase
{
    protected $connection;

    protected function setUp(): void
    {
        $this->connection = new mysqli('localhost', 'root', '', 'blog');
        if ($this->connection->connect_errno) {
            printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", $this->connection->connect_error);
            exit;
        }
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = 1; // Идентификатор пользователя, для которого меняем пароль
    }

    protected function tearDown(): void
    {
        $this->connection->close();
        session_destroy();
    }

    public function testChangePasswordWithValidData()
    {
        $newPassword = "newpassword123";
        $confirmPassword = "newpassword123";

        $_POST["new_password"] = $newPassword;
        $_POST["confirm_password"] = $confirmPassword;

        require 'reset-password.php';


        $this->assertStringContainsString("location: login.php", $this->getHeader());
        $this->assertTrue($this->isPasswordChanged($newPassword));
    }

    protected function getHeader()
    {
        $headers = xdebug_get_headers();
        return end($headers);
    }

    protected function isPasswordChanged($newPassword)
    {
        $userId = $_SESSION["id"];
        $result = $this->connection->query("SELECT password FROM users WHERE id = {$userId}");
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];
        return password_verify($newPassword, $hashedPassword);
    }
}