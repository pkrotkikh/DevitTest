<?php

namespace App\Console\Commands;

use App\DTO\PostDTO;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Console\Command;
use Vedmant\FeedReader\Facades\FeedReader;

class GetRSSPosts extends Command
{
    private PostRepositoryInterface $postRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
    )
    {
        parent::__construct();
        $this->postRepository = $postRepository;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:getRSS';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get posts from RSS source';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $f = FeedReader::read('https://lifehacker.com/rss');
        $items = $f->get_items();
        foreach ($items as $key => $item) {
            $postsDTO = PostDTO::fromRSS($item);
            $post = $this->postRepository->createPost($postsDTO);

            if($post && !empty($postsDTO->categories)) {
                $this->postRepository->syncCategories($post, $postsDTO);
            }
        }
        return true;
    }
}
