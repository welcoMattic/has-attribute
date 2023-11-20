<?php

namespace Welcomattic\HasAttribute;

enum HasAttributeMode
{
    case ATTRIBUTES_ONE_OF;
    case ATTRIBUTES_ALL_OF;
    case ATTRIBUTES_ANY_OF;
}
