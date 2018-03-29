#!/usr/bin/env php
<?php
$tmp = file_get_contents(__DIR__ . '/Dockerfile');
$old = substr($tmp, strpos($tmp, 'git checkout -qf ') + strlen('git checkout -qf '), 40);
$new = trim(`git ls-remote https://github.com/bebbo/amiga-gcc.git | grep HEAD | awk '{ print $1}'`);

file_put_contents(
    __DIR__ . '/Dockerfile',
    str_replace($old, $new, $tmp)
);

