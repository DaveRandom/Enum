<?php declare(strict_types=1);

namespace DaveRandom\Enum\Tests;

use DaveRandom\Enum\Enum;
use PHPUnit\Framework\TestCase;

final class TestEnum extends Enum
{
    const ONE = 1;
    const TWO = 2;
    const THREE = 1;
}

final class EnumTest extends TestCase
{
    public function testToArray()
    {
        $this->assertSame(TestEnum::toArray(), ['ONE' => 1, 'TWO' => 2, 'THREE' => 1]);
    }

    public function testParseNameWithExistingName()
    {
        $this->assertSame(TestEnum::parseName('ONE'), 1);
    }

    public function testParseNameWithExistingNameCaseInsensitive()
    {
        $this->assertSame(TestEnum::parseName('one', true), 1);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testParseNameWithExistingNameCaseInsensitiveDisabled()
    {
        TestEnum::parseName('one');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testParseNameWithNonExistentName()
    {
        TestEnum::parseName('FOUR');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testParseNameWithNonExistentNameCaseInsensitive()
    {
        TestEnum::parseName('four', true);
    }

    public function testNameExistsWithExistingName()
    {
        $this->assertTrue(TestEnum::nameExists('ONE'));
    }

    public function testNameExistsWithExistingNameCaseInsensitive()
    {
        $this->assertTrue(TestEnum::nameExists('one', true));
    }

    public function testNameExistsWithExistingNameCaseInsensitiveDisabled()
    {
        $this->assertFalse(TestEnum::nameExists('one'));
    }

    public function testNameExistsWithNonExistentName()
    {
        $this->assertFalse(TestEnum::nameExists('FOUR'));
    }

    public function testNameExistsWithNonExistentNameCaseInsensitive()
    {
        $this->assertFalse(TestEnum::nameExists('four', true));
    }

    public function testParseValueWithExistingValue()
    {
        $this->assertSame(TestEnum::parseValue(1), 'ONE');
    }

    public function testParseValueWithExistingValueLoose()
    {
        $this->assertSame(TestEnum::parseValue('1', true), 'ONE');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testParseValueWithExistingValueLooseDisabled()
    {
        TestEnum::parseValue('1');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testParseValueWithNonExistentValue()
    {
        TestEnum::parseValue(4);
    }

    public function testValueExistsWithExistingValue()
    {
        $this->assertTrue(TestEnum::valueExists(1));
    }

    public function testValueExistsWithExistingValueLoose()
    {
        $this->assertTrue(TestEnum::valueExists('1', true));
    }

    public function testValueExistsWithExistingValueLooseDisabled()
    {
        $this->assertFalse(TestEnum::valueExists('1'));
    }

    public function testValueExistsWithNonExistentValue()
    {
        $this->assertFalse(TestEnum::valueExists(4));
    }

    /**
     * @expectedException \Error
     */
    public function testEnumCannotBeInstantiated()
    {
        new TestEnum;
    }
}
