<?php

/**
 * NOTE: This file is auto generated by OpenAPI Generator.
 * Do NOT edit it manually. Run `php artisan openapi:generate-server`.
 */

namespace App\Http\Support\Enums;

/*
 * Pagination types:
 * * `cursor` - Пагинация используя cursor
 * * `offset` - Пагинация используя offset
 */
enum PaginationTypeEnum: string
{
    case CURSOR = 'cursor';
    case OFFSET = 'offset';
}
