<?php

use PHPUnit\Framework\TestCase;

class ProfileTest extends TestCase
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
        $_SESSION["id"] = 1; 
    }

    protected function tearDown(): void
    {
        $this->connection->close();
        session_destroy();
    }

    public function testDisplayProfileWithoutEdit()
    {
        require 'profile.php';

        $this->assertStringContainsString("location: profile.php?edit=1", $this->getHeader());
    }

    public function testDisplayProfileWithEdit()
    {
        $_GET['edit'] = 1;

        require 'profile.php';

        $this->assertStringContainsString('value="' . $this->getUserValue('name') . '"', $this->getOutput());
        $this->assertStringContainsString('value="' . $this->getUserValue('lastname') . '"', $this->getOutput());
        $this->assertStringContainsString('value="' . $this->getUserValue('age') . '"', $this->getOutput());
        $this->assertStringContainsString('selected' . $this->getUserValue('gender'), $this->getOutput());
        $this->assertStringContainsString('value="' . $this->getUserValue('address') . '"', $this->getOutput());
        $this->assertStringContainsString('value="' . $this->getUserValue('website') . '"', $this->getOutput());
    }

    protected function getHeader()
    {
        $headers = xdebug_get_headers();
        return end($headers);
    }

    protected function getOutput()
    {
        return ob_get_clean();
    }

    protected function getUserValue($key)
    {
        $id = $_SESSION["id"];
        $result = $this->connection->query("SELECT {$key} FROM users WHERE id = {$id}");
        $row = $result->fetch_assoc();
        return $row[$key];
    }
}