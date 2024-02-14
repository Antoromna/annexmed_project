<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;


    public function it_can_create_a_post()
    {
        $post = Post::factory()->create([
            'title' => 'Test Post',
            'content' => 'Lorem ipsum dolor sit amet',

        ]);

        $this->assertNotNull($post);
    }


    public function it_validates_required_fields()
    {
        $post = new Post();
        $this->assertFalse($post->save());
    }

}
