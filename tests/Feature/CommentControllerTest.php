<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

   /**
    * Тестирование получения списка комментариев
    *
    * @return void
    */
   public function  testIndex()
   {
       Comment::factory()->count(3)->create();
       $response = $this->get('/api/comments');

       $response->assertStatus(200);

       $response->assertJsonStructure([
           '*' => [
               'id',
               'body',
               'user_id',
               'post_id',
               'created_at',
               'updated_at',
           ]
       ]);
   }

    /**
     * Тестирование создания нового комментария.
     *
     * @return void
     */
    public function testStore()
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var Post $post */
        $post = Post::factory()->create();

        $response = $this->post('/api/comments', [
            'body' => 'Это новый комментарий',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'body' => 'Это новый комментарий',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
    }

    /**
     * Тестирование получения конкретного комментария.
     *
     * @return void
     */
    public function testShow()
    {
        /** @var Comment $comment */
        $comment = Comment::factory()->create();

        $response = $this->get('/api/comments/' . $comment->id);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'id' => $comment->id,
            'body' => $comment->body,
        ]);
    }

    /**
     * Тестирование обновления комментария.
     *
     * @return void
     */
    public function testUpdate()
    {
        $comment = Comment::factory()->create();

        $response = $this->put('/api/comments/' . $comment->id, [
            'body' => 'Обновленный комментарий',
        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'body' => 'Обновленный комментарий',
        ]);
    }

    /**
     * Тестирование удаления комментария.
     *
     * @return void
     */
    public function testDestroy()
    {
        $comment = Comment::factory()->create();

        $response = $this->delete('/api/comments/' . $comment->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }
}
