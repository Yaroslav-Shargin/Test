<?php

use PHPUnit\Framework\TestCase;

class UserRegistrationTest extends TestCase
{
    protected $connection;

    protected function setUp(): void
    {
        $this->connection = new mysqli('localhost', 'root', '', 'blog');
        if ($this->connection->connect_errno) {
            printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", $this->connection->connect_error);
            exit;
        }
    }

    protected function tearDown(): void
    {
        $this->connection->close();
    }

    public function testRegistrationWithValidData()
    {
        $email = "test@example.com";
        $password = "test123";
        $confirmPassword = "test123";
        $name = "John Doe";

        $_POST["email"] = $email;
        $_POST["password"] = $password;
        $_POST["confirm_password"] = $confirmPassword;
        $_POST["text"] = $name;

        require 'register.php';

        $this->assertStringContainsString("location: login.php", $this->getHeader());

        $this->assertTrue($this->isUserRegistered($email));
    }

    protected function getHeader()
    {
        $headers = xdebug_get_headers();
        return end($headers);
    }

    protected function isUserRegistered($email)
    {
        $result = $this->connection->query("SELECT * FROM users WHERE email = '{$email}'");
        return $result->num_rows === 1;
    }
}