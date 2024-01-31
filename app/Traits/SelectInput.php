<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait SelectInput
{

    /**
     * Show the form for editing the specified resource.
     */
    public function extractKeyValueArray(Collection $collection, string $key_name, string $value_name): array
    {
        return $collection
            ->reduce(function ($collector, $item) use ($key_name, $value_name) {
                $collector[$item->{$key_name}] = $item->{$value_name};

                return $collector;
            });
    }
}
