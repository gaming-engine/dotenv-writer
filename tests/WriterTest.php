<?php

namespace GamingEngine\DotEnv\Tests;

use GamingEngine\DotEnv\File;
use GamingEngine\DotEnv\Parser;
use GamingEngine\DotEnv\Writer;
use PHPUnit\Framework\TestCase;

class WriterTest extends TestCase
{
    /**
     * @test
     */
    public function writer_load_reads_from_the_file()
    {
        // Arrange
        $subject = new Writer(
            $fileMock = $this->createMock(File::class),
            $parserMock = $this->createMock(Parser::class)
        );

        $path = md5(time());

        $fileMock->expects($this->once())
            ->method('read')
            ->with($path);

        $parserMock->expects($this->once())
            ->method('parse')
            ->willReturn([
                'testing' => 'foo',
            ]);

        // Act
        $subject->load($path);

        // Assert
    }

    /**
     * @test
     */
    public function writer_load_reads_from_the_file_and_appends_the_contents()
    {
        // Arrange
        $subject = new Writer(
            $fileMock = $this->createMock(File::class),
            $parserMock = $this->createMock(Parser::class)
        );

        $path = md5(time());

        $fileMock->expects($this->once())
            ->method('read')
            ->with($path);

        $parserMock->expects($this->once())
            ->method('parse')
            ->willReturn([
                'testing' => 'foo',
            ]);

        $subject->setValue('blarg', 10);

        // Act
        $subject->load($path);

        // Assert
        $this->assertEquals(
            "blarg=10" . PHP_EOL . "testing=foo",
            (string)$subject
        );
    }

    /**
     * @test
     */
    public function writer_is_able_to_add_values_fluently()
    {
        // Arrange
        $subject = new Writer();

        // Act
        $result = $subject->setValue('foo', 10);

        // Assert
        $this->assertTrue($subject === $result);
    }

    /**
     * @test
     */
    public function writer_is_able_to_retrieve_values_once_set()
    {
        // Arrange
        $subject = new Writer();

        $subject->setValue('foo', 10);

        // Act
        $result = $subject->getValue('foo');

        // Assert
        $this->assertEquals(
            10,
            $result
        );
    }

    /**
     * @test
     */
    public function writer_can_write_the_configuration_to_a_file()
    {
        $subject = new Writer(
            $fileMock = $this->createMock(File::class)
        );

        $path = md5(time());

        $subject->setValue('foo', 10)
            ->setValue('bar', "testing");

        $fileMock->expects($this->once())
            ->method('write')
            ->with($path, "foo=10" . PHP_EOL . "bar=testing");

        // Act
        $subject->write($path);

        // Assert
    }

    /**
     * @test
     */
    public function writer_is_able_to_convert_the_environment_to_a_string()
    {
        $subject = new Writer();

        $subject->setValue('foo', 10)
            ->setValue('bar', "testing");

        // Act
        $result = (string)$subject;

        // Assert
        $this->assertEquals(
            "foo=10" . PHP_EOL . "bar=testing",
            $result
        );
    }
}