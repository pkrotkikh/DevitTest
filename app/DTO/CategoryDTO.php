<?php

namespace App\DTO;

use SimplePie_Item;
use Spatie\DataTransferObject\DataTransferObject;

final class CategoryDTO extends DataTransferObject
{
    public ?int $id;
    public string $name;

    public static function fromArray(array $array) :self {
        return new self([
            "name" => $array["name"],
        ]);
    }
}
