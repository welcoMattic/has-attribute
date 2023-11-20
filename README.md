# HasAttribute

For years, PHP has made it easy to check whether an object is an instance of a given class. However, it's not as simple to check that an object's class has Attribute.

This package provides some functions to make it easier to check whether an object's class has a given Attribute.

## Installation

```bash
$ composer require welcomattic/has-attribute
```

## Usage

```php
use Welcomattic\HasAttribute\HasAttributeMode;

#[\Attribute(\Attribute::TARGET_CLASS)]
class ClassAttribute {}

#[\Attribute(\Attribute::TARGET_CLASS)]
class SecondClassAttribute {}

#[\Attribute(\Attribute::TARGET_CLASS)]
class ThirdClassAttribute {}

#[ClassAttribute]
#[SecondClassAttribute]
class Foo {}

class_has_attribute(Foo::class, ClassAttribute::class); // true
class_has_attribute(Foo::class, ThirdClassAttribute::class); // false
class_has_attribute(Foo::class, [ClassAttribute::class, SecondClassAttribute::class]); // true
class_has_attribute(Foo::class, [ClassAttribute::class, SecondClassAttribute::class], HasAttributeMode::ATTRIBUTES_ALL_OF); // true (default mode)
class_has_attribute(Foo::class, [ClassAttribute::class, SecondClassAttribute::class], HasAttributeMode::ATTRIBUTES_ANY_OF); // true
class_has_attribute(Foo::class, [ClassAttribute::class, SecondClassAttribute::class], HasAttributeMode::ATTRIBUTES_ONE_OF); // false
```

You can also check on object methods or properties:

```php
#[\Attribute(\Attribute::TARGET_METHOD)]
class MethodAttribute {}

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class PropertyAttribute {}

class Foo {
    #[MethodAttribute]
    public function bar() {}
    
    #[PropertyAttribute]
    public $baz;
}

method_has_attribute(Foo::class, MethodAttribute::class, 'bar'); // true
property_has_attribute(Foo::class, PropertyAttribute::class, 'baz'); // true
```

## Credits

This package is based on an idea from [lyrixx](https://github.com/lyrixx), and was implemented by [welcomattic](https://github.com/welcomattic) and [Korbeil](https://github.com/Korbeil).
