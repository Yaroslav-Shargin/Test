<?php

use PHPUnit\Framework\TestCase;

class BlogTest extends TestCase
{
    public function testPostCreationSuccess()
    {
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_SESSION['id'] = 1;
        $_POST["title"] = "Test Title";
        $_POST["description"] = "Test Description";
        $_POST["body"] = "Test Body";

        $connectionMock = $this->getMockBuilder(mysqli::class)
            ->disableOriginalConstructor()
            ->getMock();

        $stmtMock = $this->getMockBuilder(mysqli_stmt::class)
            ->disableOriginalConstructor()
            ->getMock();

        $connectionMock->expects($this->once())
            ->method('prepare')
            ->with($this->equalTo("INSERT INTO `posts` (`id`, `user`, `title`, `description`, `body`) VALUES (NULL, ?, ?, ?, ?);"))
            ->willReturn($stmtMock);

        $stmtMock->expects($this->once())
            ->method('bind_param')
            ->with($this->equalTo("isss"), $this->equalTo($_SESSION['id']), $this->equalTo($_POST["title"]), $this->equalTo($_POST["description"]), $this->equalTo($_POST["body"]))
            ->willReturn(true);

        $stmtMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $stmtMock->expects($this->once())
            ->method('close');

        global $connection;
        $connection = $connectionMock;

        ob_start();
        require 'post.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('Location: index.php', $output);

        $this->assertEquals("Blog Post posted successfully!", $_SESSION['success_message']);
    }
}