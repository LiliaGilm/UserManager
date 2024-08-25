<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * Тестирование получения списка постов
     *
     * @return void
     */
    public function  testIndex()
    {
        Post::factory()->count(3)->create();
        $response = $this->get('/api/posts');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /**
     * Тестирование создания нового поста.
     *
     * @return void
     */
    public function testStore()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->post('/api/posts', [
            'body' => 'Это новый пост',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'body' => 'Это новый пост',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Тестирование получения конкретного поста.
     *
     * @return void
     */
    public function testShow()
    {
        /** @var Post $post */
        $post = Post::factory()->create();

        $response = $this->get('/api/posts/' . $post->id);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'id' => $post->id,
            'body' => $post->body,
        ]);
    }

    /**
     * Тестирование обновления поста.
     *
     * @return void
     */
    public function testUpdate()
    {
        /** @var Post $post */
        $post = Post::factory()->create();

        $response = $this->put('/api/posts/' . $post->id, [
            'body' => 'Обновленный пост',
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'body' => 'Обновленный пост',
        ]);
    }

    /**
     * Тестирование удаления поста.
     *
     * @return void
     */
    public function testDestroy()
    {
        /** @var Post $post */
        $post = Post::factory()->create();

        $response = $this->delete('/api/posts/' . $post->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
