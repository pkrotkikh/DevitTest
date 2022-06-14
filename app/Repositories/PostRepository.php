<?php

namespace App\Repositories;

use App\DTO\CategoryDTO;
use App\DTO\PostDTO;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;

class PostRepository implements PostRepositoryInterface
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllPosts() : Collection
    {
        return Post::all();
    }

    public function getPostById($postId) : Post
    {
        return Post::findOrFail($postId);
    }

    public function getPostByUid($postUid) : Post
    {
        return Post::where("uid", $postUid)->first();
    }

    public function isPostExists($postUid) : bool
    {
        return Post::where("uid", $postUid)->exists();
    }

    public function deletePost($postId) : int
    {
        return Post::destroy($postId);
    }

    public function createPost(PostDTO $postDTO) : Post|bool
    {
        $isPostExists = $this->isPostExists($postDTO->uid);

        if ( $isPostExists ) {
            return false;
        }

        $post = new Post();
        $post->uid = $postDTO->uid;
        $post->title = $postDTO->title;
        $post->link = $postDTO->link;
        $post->description = $postDTO->description;
        $post->author_name = $postDTO->author_name;
        $post->save();
        return $post;
    }

    public function updatePost(int $postId, PostDTO $postDTO) : Post
    {
        $post = $this->getPostById($postId);
        $post->uid = $postDTO->uid;
        $post->title = $postDTO->title;
        $post->link = $postDTO->link;
        $post->description = $postDTO->description;
        $post->author_name = $postDTO->author_name;
        $post->save();
        return $post;
    }

    public function syncCategories(Post $post, PostDTO $postDTO) : self
    {
        $postsCategories = [];

        foreach ($postDTO->categories as $category) {
            $isCategoryExists = $this->categoryRepository->isCategoryExistsByName($category["name"]);

            if($isCategoryExists) {
                $category = $this->categoryRepository->getCategoryByName($category["name"]);
            } else {
                $categoryDTO = CategoryDTO::fromArray($category);
                $category = $this->categoryRepository->createCategory($categoryDTO);
            }

            $postsCategories[] = $category->id;
        }

        $post->categories()->sync($postsCategories);

        return $this;
    }
}
