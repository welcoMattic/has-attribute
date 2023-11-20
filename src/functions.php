<?php

use Welcomattic\HasAttribute\HasAttribute;
use Welcomattic\HasAttribute\HasAttributeMode;

/**
 * @param object|class-string $subject
 * @param class-string[]|class-string $attribute
 */
function has_attribute(object|string $subject, array|string $attribute, HasAttributeMode $mode = HasAttributeMode::ATTRIBUTES_ONE_OF): bool
{
    return class_has_attribute($subject, $attribute, $mode);
}

/**
 * @param object|class-string $subject
 * @param class-string[]|class-string $attribute
 */
function class_has_attribute(object|string $subject, array|string $attribute, HasAttributeMode $mode = HasAttributeMode::ATTRIBUTES_ONE_OF): bool
{
    return HasAttribute::classHasAttribute($subject, $attribute, $mode);
}

/**
 * @param object|class-string $subject
 * @param class-string[]|class-string $attribute
 */
function method_has_attribute(object|string $subject, string $methodName, array|string $attribute, HasAttributeMode $mode = HasAttributeMode::ATTRIBUTES_ONE_OF): bool
{
    return HasAttribute::methodHasAttribute($subject, $methodName, $attribute, $mode);
}

/**
 * @param object|class-string $subject
 * @param class-string[]|class-string $attribute
 */
function property_has_attribute(object|string $subject, string $propertyName, array|string $attribute, HasAttributeMode $mode = HasAttributeMode::ATTRIBUTES_ONE_OF): bool
{
    return HasAttribute::propertyHasAttribute($subject, $propertyName, $attribute, $mode);
}
