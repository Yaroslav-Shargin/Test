<?php

use PHPUnit\Framework\TestCase;

class BlogPostTest extends TestCase
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

    public function testDisplayPostWithComments()
    {
        $postId = 1;
        $postTitle = "Test Post Title";
        $postDescription = "Test Post Description";
        $postBody = "Test Post Body";
        $comments = [
            ['name' => 'John Doe', 'comment' => 'Test Comment 1'],
            ['name' => 'Jane Smith', 'comment' => 'Test Comment 2']
        ];

        $this->insertTestPostAndComments($postId, $postTitle, $postDescription, $postBody, $comments);

        $outputBuffer = new OutputBufferingTestTrait();

        $outputBuffer->start();
        require 'article.php';
        $output = $outputBuffer->end();

        $this->assertStringContainsString($postTitle, $output);
        $this->assertStringContainsString($postDescription, $output);
        $this->assertStringContainsString($postBody, $output);

        foreach ($comments as $comment) {
            $this->assertStringContainsString($comment['name'], $output);
            $this->assertStringContainsString($comment['comment'], $output);
        }
    }

    protected function insertTestPostAndComments($postId, $postTitle, $postDescription, $postBody, $comments)
    {
        $this->connection->query("INSERT INTO `posts` (`id`, `title`, `description`, `body`) VALUES ({$postId}, '{$postTitle}', '{$postDescription}', '{$postBody}')");

        foreach ($comments as $comment) {
            $this->connection->query("INSERT INTO `comments` (`post`, `name`, `comment`) VALUES ({$postId}, '{$comment['name']}', '{$comment['comment']}')");
        }
    }
}