<?php

namespace App\Http\Controllers\Api;

use App\DTO\PostDTO;
use App\Http\Requests\PostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
    )
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        return $this->postRepository->getAllPosts();
    }

    public function show(int $id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function store(PostRequest $request)
    {
        $postDTO = PostDTO::fromRequest($request);
        $post = $this->postRepository->createPost($postDTO);

        if ($post && !empty($postDTO->categories)) {
            $this->postRepository->syncCategories($post, $postDTO);
        }

        return response()->json($post, 201);
    }

    public function update(PostRequest $request, Post $post)
    {
        $postDTO = PostDTO::fromRequest($request);
        $post = $this->postRepository->updatePost($post->id, $postDTO);

        return response()->json($post, 200);
    }

    public function delete(int $id)
    {
        $this->postRepository->deletePost($id);

        return response()->json(null, 204);
    }
}
