<?php
use PHPUnit\Framework\TestCase;

class loginTest extends TestCase
{
    public function testValidLogin()
    {
        $_POST["name"] = "JohnDoe";
        $_POST["password"] = "password123";

        $mockConnection = $this->createMock(mysqli::class);
        $mockStmt = $this->createMock(mysqli_stmt::class);

        $mockStmt->method("num_rows")
            ->willReturn(1);

        $mockStmt->method("fetch")
            ->willReturn(true);

        $mockConnection->method("prepare")
            ->willReturn($mockStmt);

        $this->expectOutputString("Location: index.php");

        include "login.php";
    }

    public function testInvalidLogin()
    {
        // Simulating an invalid login attempt
        $_POST["name"] = "InvalidUser";
        $_POST["password"] = "invalidPassword";

        $mockConnection = $this->createMock(mysqli::class);
        $mockStmt = $this->createMock(mysqli_stmt::class);

        $mockStmt->method("num_rows")
            ->willReturn(0);

        $mockConnection->method("prepare")
            ->willReturn($mockStmt);

        $this->expectOutputString("Invalid name or password.");

        include "login.php";
    }

    public function testEmptyFields()
    {
        // Simulating empty form fields
        $_POST["name"] = "";
        $_POST["password"] = "";

        $this->expectOutputString("Please enter name.Please enter your password.");

        include "login.php";
    }
}