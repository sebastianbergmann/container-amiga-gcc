#!/usr/bin/env php
<?php declare(strict_types=1);
$tmp = file_get_contents(__DIR__ . '/Dockerfile');
$old = substr($tmp, strpos($tmp, 'git checkout -qf ') + strlen('git checkout -qf '), 40);
$new = trim(`git ls-remote https://github.com/bebbo/amiga-gcc.git | grep HEAD | awk '{ print $1}'`);

file_put_contents(
    __DIR__ . '/Dockerfile',
    str_replace($old, $new, $tmp)
);

$repositories = [
    'adtools/sfdc',
    'AmigaPorts/libSDL12',
    'bebbo/amiga-netinclude',
    'bebbo/aros-stuff',
    'bebbo/binutils-gdb',
    'bebbo/clib2',
    'bebbo/fd2pragma',
    'bebbo/gcc',
    'bebbo/ira',
    'bebbo/ixemul',
    'bebbo/libdebug',
    'bebbo/libnix',
    'bebbo/newlib-cygwin',
    'bebbo/vbcc',
    'cahirwpz/fd2sfd',
    'jca02266/lha',
    'leffmann/vasm',
    'leffmann/vlink',
];

foreach ($repositories as $repository) {
    $file = __DIR__ . '/.revisions/' . $repository;
    $old  = trim(file_get_contents($file)); 

    $new = trim(
        shell_exec(
            'git ls-remote https://github.com/' . $repository . '.git | grep HEAD | awk \'{ print $1}\''
        )
    );

    if ($old !== $new) {
        print $repository . ' has new commits' . PHP_EOL;

        file_put_contents($file, $new);
    }
}

