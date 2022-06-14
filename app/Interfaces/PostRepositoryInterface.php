<?php
namespace App\Interfaces;

use App\DTO\PostDTO;
use App\Models\Post;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getPostById($postId);
    public function deletePost($postId);
    public function createPost(PostDTO $postDTO);
    public function updatePost(int $postId, PostDTO $postDTO);
    public function syncCategories(Post $post, PostDTO $postDTO);
}
