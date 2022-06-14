<?php

namespace App\DTO;

use App\Http\Requests\PostRequest;
use SimplePie_Item;
use Spatie\DataTransferObject\DataTransferObject;

final class PostDTO extends DataTransferObject
{
    public ?int $id;
    public int $uid;
    public string $title;
    public string $link;
    public string $description;
    public array $categories;
    public string $author_name;


    private static function getCategories(array $categories)
    {
        $result = [];
        foreach ($categories as $key => $category){
            $result[$key]["name"] = $category->get_term();
        }
        return $result;
    }


    public static function fromRSS(SimplePie_Item $item): self {
        return new self([
            'uid' => $item->get_id(),
            'title' => $item->get_title(),
            'link' => $item->get_link(),
            'description' => $item->get_description(),
            'categories' => self::getCategories($item->get_categories()),
            'author_name' => !empty($item->get_author()) ? $item->get_author()->name : "",
        ]);
    }

    public static function fromRequest(PostRequest $request) :self {
        return new self([
            'uid' => $request->uid,
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
            'categories' => $request->categories,
            'author_name' => $request->author_name,
        ]);
    }
}
