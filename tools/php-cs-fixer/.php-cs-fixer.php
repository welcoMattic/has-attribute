<?php

$root = __DIR__ . '/../..';
$finder = PhpCsFixer\Finder::create()
    ->in($root . '/src')
    ->in($root . '/tests')
;


return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP81Migration' => true,
        '@PhpCsFixer' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'heredoc_indentation' => false,
        'php_unit_internal_class' => false, // From @PhpCsFixer but we don't want it
        'php_unit_test_class_requires_covers' => false, // From @PhpCsFixer but we don't want it
        'phpdoc_add_missing_param_annotation' => false, // From @PhpCsFixer but we don't want it
        'phpdoc_align' => false, // From @PhpCsFixer but we don't want it
        'concat_space' => ['spacing' => 'one'],
        'ordered_class_elements' => true, // Symfony(PSR12) override the default value, but we don't want
        'blank_line_before_statement' => true, // Symfony(PSR12) override the default value, but we don't want
    ])
    ->setFinder($finder)
;
