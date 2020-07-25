<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Tests\Exception;

use Doctrine\DBAL\Exception\InvalidPlatformType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use PHPUnit\Framework\TestCase;
use stdClass;

class InvalidPlatformTypeTest extends TestCase
{
    /**
     * @group #2821
     */
    public function testInvalidPlatformTypeObject(): void
    {
        $exception = InvalidPlatformType::new(new stdClass());

        self::assertSame(
            'Option "platform" must be a subtype of ' . AbstractPlatform::class . ', instance of stdClass given.',
            $exception->getMessage()
        );
    }

    /**
     * @group #2821
     */
    public function testInvalidPlatformTypeScalar(): void
    {
        $exception = InvalidPlatformType::new('some string');

        self::assertSame(
            'Option "platform" must be an object and subtype of ' . AbstractPlatform::class . '. Got string.',
            $exception->getMessage()
        );
    }
}
