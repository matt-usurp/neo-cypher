<?php

return PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setRules(
        [
            '@Symfony' => true,

            'concat_space' => ['spacing' => 'one'],
            'array_syntax' => ['syntax' => 'short'],
            'protected_to_private' => true,
            'yoda_style' => false,

            'class_definition' => [
                'singleLine' => false,
                'singleItemSingleLine' => false,
                'multiLineExtendsEachSingleLine' => false,
            ],

            'no_multiline_whitespace_before_semicolons' => true,
            'no_extra_consecutive_blank_lines' => false,
            'no_extra_blank_lines' => [
                'tokens' => [
                    'switch',
                    'curly_brace_block',
                    'parenthesis_brace_block',
                    'extra',
                ]
            ],

            'phpdoc_add_missing_param_annotation' => ['only_untyped' => false],
            'phpdoc_inline_tag' => true,
            'phpdoc_align' => false,
            'phpdoc_indent' => false,
            'phpdoc_order' => true,
            'phpdoc_separation' => true,
            'phpdoc_annotation_without_dot' => false,
            'phpdoc_var_without_name' => false,
            'phpdoc_types_order' => ['null_adjustment' => 'always_last']
        ]
    )
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in('src')
            ->name('*.php')
    );
