<?php

namespace Welcomattic\HasAttribute;

/**
 * @template T of object
 */
final class HasAttribute
{
    /**
     * @var array<string, \ReflectionMethod>
     */
    private static array $methodCache = [];

    /**
     * @var array<string, \ReflectionProperty>
     */
    private static array $propertyCache = [];

    /**
     * @var array<class-string, \ReflectionClass<T>>
     */
    private static array $classCache = [];

    /**
     * @param T|class-string<T> $subject
     * @param class-string[]|class-string $attribute
     */
    public static function classHasAttribute(object|string $subject, array|string $attribute, HasAttributeMode $mode = HasAttributeMode::ATTRIBUTES_ONE_OF): bool
    {
        $reflectionClass = self::createReflection($subject);

        return self::_hasAttribute($reflectionClass, (array) $attribute, $mode);
    }

    /**
     * @param T|class-string<T> $subject
     * @param class-string[]|class-string $attribute
     */
    public static function methodHasAttribute(object|string $subject, string $methodName, array|string $attribute, HasAttributeMode $mode = HasAttributeMode::ATTRIBUTES_ONE_OF): bool
    {
        $reflectionClass = self::createReflection($subject);
        $cacheKey = self::getClassName($subject) . $methodName;
        self::$methodCache[$cacheKey] ??= $reflectionClass->getMethod($methodName);

        return self::_hasAttribute(self::$methodCache[$cacheKey], (array) $attribute, $mode);
    }

    /**
     * @param T|class-string<T> $subject
     * @param class-string[]|class-string $attribute
     */
    public static function propertyHasAttribute(object|string $subject, string $propertyName, array|string $attribute, HasAttributeMode $mode = HasAttributeMode::ATTRIBUTES_ONE_OF): bool
    {
        $reflectionClass = self::createReflection($subject);
        $cacheKey = self::getClassName($subject) . $propertyName;
        self::$propertyCache[$cacheKey] ??= $reflectionClass->getProperty($propertyName);

        return self::_hasAttribute(self::$propertyCache[$cacheKey], (array) $attribute, $mode);
    }

    /**
     * @param \ReflectionClass<T>|\ReflectionMethod|\ReflectionProperty $reflection
     * @param class-string[] $attributes
     */
    private static function _hasAttribute(\ReflectionClass|\ReflectionMethod|\ReflectionProperty $reflection, array $attributes, HasAttributeMode $mode): bool
    {
        $foundAttributes = [];
        foreach ($attributes as $attribute) {
            if ($reflection->getAttributes($attribute, \ReflectionAttribute::IS_INSTANCEOF)[0] ?? false) {
                $foundAttributes[] = $attribute;
            }
        }

        return match ($mode) {
            HasAttributeMode::ATTRIBUTES_ONE_OF => 1 === \count($foundAttributes),
            HasAttributeMode::ATTRIBUTES_ALL_OF => \count($attributes) === \count($foundAttributes),
            HasAttributeMode::ATTRIBUTES_ANY_OF => \count($foundAttributes) > 0,
        };
    }

    /**
     * @param T|class-string<T> $subject
     *
     * @return \ReflectionClass<T>
     */
    private static function createReflection(object|string $subject): \ReflectionClass
    {
        return self::$classCache[self::getClassName($subject)] ??= new \ReflectionClass($subject);
    }

    /**
     * @param object|class-string $subject
     *
     * @return class-string
     */
    private static function getClassName(object|string $subject): string
    {
        return \is_object($subject) ? $subject::class : $subject;
    }
}
