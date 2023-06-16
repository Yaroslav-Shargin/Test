<?php

use PHPUnit\Framework\TestCase;

class UpdateProfileTest extends TestCase
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
        $_SESSION["id"] = 1; // Идентификатор пользователя, для которого обновляем профиль
    }

    protected function tearDown(): void
    {
        $this->connection->close();
        session_destroy();
    }

    public function testUpdateProfileWithValidData()
    {
        // Создаем фиктивные данные
        $name = "John";
        $lastname = "Doe";
        $age = 30;
        $gender = "Male";
        $address = "123 Street";
        $website = "example.com";

        // Подготавливаем данные для отправки
        $_POST["update"] = true;
        $_POST["name"] = $name;
        $_POST["lastname"] = $lastname;
        $_POST["age"] = $age;
        $_POST["gender"] = $gender;
        $_POST["address"] = $address;
        $_POST["website"] = $website;

        require 'profileScript.php';

        $this->assertStringContainsString("location: index.php", $this->getHeader());

        $this->assertTrue($this->isProfileUpdated($name, $lastname, $age, $gender, $address, $website));
    }

    protected function getHeader()
    {
        $headers = xdebug_get_headers();
        return end($headers);
    }

    protected function isProfileUpdated($name, $lastname, $age, $gender, $address, $website)
    {
        $id = $_SESSION["id"];
        $result = $this->connection->query("SELECT * FROM users WHERE id = {$id}");
        $row = $result->fetch_assoc();
        return $row["name"] === $name
            && $row["lastname"] === $lastname
            && $row["age"] == $age
            && $row["gender"] === $gender
            && $row["address"] === $address
            && $row["website"] === $website;
    }
}
?>