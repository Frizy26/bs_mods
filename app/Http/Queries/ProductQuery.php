<?php

namespace App\Http\Queries;

use App\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Product::query());

        $this->allowedIncludes([
            'orders',
            'category',
        ]);

        $this->defaultSort('id');

        $this->allowedFilters([
            AllowedFilter::scope('price', 'price'),
            AllowedFilter::exact('type_category_id'),
            AllowedFilter::exact('typeCategory.name')
        ]);

        $this->allowedSorts([
            'price',
        ]);
    }
}
