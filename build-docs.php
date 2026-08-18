<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Docsmith\Docsmith;

Docsmith::make()
    ->readmeIndex(__DIR__ . '/README.md')
    ->readmeSkipSections(['Contributing', 'Author'])
    ->output(__DIR__ . '/docs')
    ->title('Laravel Undocumented Features')
    ->description('A curated list of Laravel features that are not (or barely) documented in the official Laravel docs.')
    ->repositoryUrl('https://github.com/mrpunyapal/laravel-undocumented')
    ->editBranch('main')
    ->build();