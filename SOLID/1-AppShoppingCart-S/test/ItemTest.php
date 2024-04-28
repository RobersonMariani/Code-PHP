<?php

use App\Item;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testEstadoInicialItem()
    {
        $item = new Item();

        $this->assertEquals("", $item->getDescription());
        $this->assertEquals(0, $item->getValue());
    }

    public function testGeteSetDescription()
    {
        $description  = "Cadeira de plástico";

        $item = new Item();
        $item->setDescription($description);
        $this->assertEquals($description, $item->getDescription());
    }

    public static function dataValues(): array
    {
        return [
            [100],
            [-2],
            [0]
        ];
    }

    #[DataProvider('dataValues')]
    public function testGeteSetValue($value)
    {
        $item = new Item();
        $item->setValue($value);
        $this->assertEquals($value, $item->getValue());
    }

    public function testValidateItem()
    {
        $item = new Item();
        $item->setValue(55);
        $item->setDescription('Cadeira de metal');
        $this->assertEquals(true, $item->validateItem());

        $item->setValue(55);
        $item->setDescription('');
        $this->assertEquals(false, $item->validateItem());

        $item->setValue(0);
        $item->setDescription('');
        $this->assertEquals(false, $item->validateItem());
    }

}
