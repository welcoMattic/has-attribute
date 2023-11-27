<?php

namespace Welcomattic\HasAttribute\Tests;

use PHPUnit\Framework\TestCase;
use Welcomattic\HasAttribute\HasAttributeMode;

class HasAttributeTest extends TestCase
{
    public function testClassHasAttribute(): void
    {
        $this->assertTrue(class_has_attribute(Foo::class, [ClassAttribute::class, AnotherAnotherClassAttribute::class]));
        $this->assertFalse(class_has_attribute(Foo::class, [ClassAttribute::class, AnotherClassAttribute::class]));
        $this->assertTrue(class_has_attribute(Foo::class, [ClassAttribute::class, AnotherClassAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertTrue(class_has_attribute(Foo::class, [ClassAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertTrue(class_has_attribute(Foo::class, [ClassAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertTrue(class_has_attribute(Foo::class, [ClassAttribute::class, AnotherClassAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertFalse(class_has_attribute(Foo::class, [AnotherAnotherClassAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));

        $this->assertTrue(class_has_attribute(Bar::class, [ClassAttribute::class]));
        $this->assertTrue(class_has_attribute(Bar::class, [ClassAttribute::class, AnotherClassAttribute::class]));
        $this->assertFalse(class_has_attribute(Bar::class, [ClassAttribute::class, AnotherClassAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertTrue(class_has_attribute(Bar::class, [ClassAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertTrue(class_has_attribute(Bar::class, [ClassAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertTrue(class_has_attribute(Bar::class, [ClassAttribute::class, AnotherClassAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertFalse(class_has_attribute(Bar::class, [AnotherAnotherClassAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));

        $this->assertTrue(class_has_attribute(Baz::class, [ClassAttributeInterface::class]));
    }

    public function testMethodHasAttribute(): void
    {
        $this->assertTrue(method_has_attribute(Foo::class, 'toString', [MethodAttribute::class]));
        $this->assertFalse(method_has_attribute(Foo::class, 'toString', [AnotherMethodAttribute::class]));
        $this->assertTrue(method_has_attribute(Foo::class, 'toString', [MethodAttribute::class, AnotherAnotherMethodAttribute::class]));
        $this->assertFalse(method_has_attribute(Foo::class, 'toArray', [MethodAttribute::class]));
        $this->assertTrue(method_has_attribute(Foo::class, 'toArray', [AnotherMethodAttribute::class]));
        $this->assertTrue(method_has_attribute(Foo::class, 'toArray', [MethodAttribute::class, AnotherAnotherMethodAttribute::class]));

        $this->assertTrue(method_has_attribute(Foo::class, 'toString', [MethodAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertFalse(method_has_attribute(Foo::class, 'toString', [AnotherMethodAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertTrue(method_has_attribute(Foo::class, 'toArray', [AnotherMethodAttribute::class, AnotherAnotherMethodAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertFalse(method_has_attribute(Foo::class, 'toArray', [MethodAttribute::class, AnotherAnotherMethodAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));

        $this->assertTrue(method_has_attribute(Foo::class, 'toString', [MethodAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertTrue(method_has_attribute(Foo::class, 'toString', [MethodAttribute::class, AnotherAnotherMethodAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertFalse(method_has_attribute(Foo::class, 'toString', [AnotherMethodAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertTrue(method_has_attribute(Foo::class, 'toArray', [AnotherMethodAttribute::class, AnotherAnotherMethodAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertTrue(method_has_attribute(Foo::class, 'toArray', [MethodAttribute::class, AnotherAnotherMethodAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertFalse(method_has_attribute(Foo::class, 'toArray', [MethodAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));

        $this->assertTrue(method_has_attribute(Fooo::class, 'barbaz', [Fooo_BarBazAttribute::class]));
        $this->assertFalse(method_has_attribute(Fooo::class, 'barbaz', [FoooBar_BarAttribute::class]));

        $this->assertTrue(method_has_attribute(Fooobar::class, 'baz', [FoooBar_BarAttribute::class]));
        $this->assertFalse(method_has_attribute(Fooobar::class, 'baz', [Fooo_BarBazAttribute::class]));
    }

    public function testPropertyHasAttribute(): void
    {
        $this->assertTrue(property_has_attribute(Foo::class, 'string', [PropertyAttribute::class]));
        $this->assertFalse(property_has_attribute(Foo::class, 'string', [AnotherAnotherPropertyAttribute::class]));
        $this->assertTrue(property_has_attribute(Foo::class, 'string', [PropertyAttribute::class, AnotherAnotherPropertyAttribute::class]));
        $this->assertFalse(property_has_attribute(Foo::class, 'array', [PropertyAttribute::class]));
        $this->assertTrue(property_has_attribute(Foo::class, 'array', [AnotherPropertyAttribute::class]));
        $this->assertTrue(property_has_attribute(Foo::class, 'array', [PropertyAttribute::class, AnotherAnotherPropertyAttribute::class]));

        $this->assertTrue(property_has_attribute(Foo::class, 'string', [PropertyAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertTrue(property_has_attribute(Foo::class, 'string', [PropertyAttribute::class, AnotherPropertyAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));
        $this->assertFalse(property_has_attribute(Foo::class, 'string', [AnotherAnotherPropertyAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF));

        $this->assertTrue(property_has_attribute(Foo::class, 'string', [PropertyAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertFalse(property_has_attribute(Foo::class, 'string', [AnotherAnotherPropertyAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertTrue(property_has_attribute(Foo::class, 'string', [PropertyAttribute::class, AnotherPropertyAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
        $this->assertFalse(property_has_attribute(Foo::class, 'string', [AnotherAnotherPropertyAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF));
    }
}

#[\Attribute(\Attribute::TARGET_CLASS)]
class ClassAttribute {}

#[\Attribute(\Attribute::TARGET_CLASS)]
class AnotherClassAttribute {}

#[\Attribute(\Attribute::TARGET_CLASS)]
class AnotherAnotherClassAttribute {}

class ClassAttributeInterface {}

#[\Attribute(\Attribute::TARGET_CLASS)]
class ChildClassAttribute extends ClassAttributeInterface {}

#[\Attribute(\Attribute::TARGET_METHOD)]
class MethodAttribute {}

#[\Attribute(\Attribute::TARGET_METHOD)]
class AnotherMethodAttribute {}

#[\Attribute(\Attribute::TARGET_METHOD)]
class AnotherAnotherMethodAttribute {}

#[\Attribute(\Attribute::TARGET_METHOD)]
class FoooBar_BarAttribute {}

#[\Attribute(\Attribute::TARGET_METHOD)]
class Fooo_BarBazAttribute {}

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class PropertyAttribute {}

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class AnotherPropertyAttribute {}

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class AnotherAnotherPropertyAttribute {}

#[ClassAttribute]
#[AnotherClassAttribute]
class Foo
{
    #[PropertyAttribute]
    #[AnotherPropertyAttribute]
    private string $string;

    #[AnotherPropertyAttribute]
    #[AnotherAnotherPropertyAttribute]
    private string $array;

    #[MethodAttribute]
    public function toString(): string
    {
        return 'string';
    }

    #[AnotherMethodAttribute]
    #[AnotherAnotherMethodAttribute]
    public function toArray(): array
    {
        return [];
    }
}

#[ClassAttribute]
class Bar {}

#[ChildClassAttribute]
class Baz {}

class Fooobar
{
    #[FoooBar_BarAttribute]
    public function baz() {}
}

class Fooo
{
    #[Fooo_BarBazAttribute]
    public function barbaz() {}
}
