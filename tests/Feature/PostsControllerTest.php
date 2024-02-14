<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;

class PostsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_post()
    {
        $response = $this->post(route('posts.store'), [
            'title' => 'Test Post',
            'content' => 'Lorem ipsum dolor sit amet',
            // Add other required fields
        ]);

        $response->assertStatus(302); // Check if the response is a redirect after successful creation
        // Add more assertions to verify the created post
    }

    /** @test */
    public function it_can_show_a_post()
    {
        // Your test logic to show a post and assert its details
    }

    // Add more test methods for other CRUD operations
}
