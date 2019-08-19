#!/usr/bin/env php
<?php declare(strict_types=1);
$tmp = file_get_contents(__DIR__ . '/Dockerfile');
$old = substr($tmp, strpos($tmp, 'git checkout -qf ') + strlen('git checkout -qf '), 40);
$new = trim(`git ls-remote https://github.com/bebbo/amiga-gcc.git | grep HEAD | awk '{ print $1}'`);

file_put_contents(
    __DIR__ . '/Dockerfile',
    str_replace($old, $new, $tmp)
);

$old = '';

if (file_exists(__DIR__ . '/gcc-latest-commit')) {
    $old = trim(file_get_contents(__DIR__ . '/gcc-latest-commit'));
}

$new = trim(`git ls-remote https://github.com/bebbo/gcc.git | grep HEAD | awk '{ print $1}'`);

if ($old !== $new) {
    print 'https://github.com/bebbo/gcc.git has new commits' . PHP_EOL;

    file_put_contents(__DIR__ . '/gcc-latest-commit', $new);
}


