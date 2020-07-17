<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class PartsTest extends TestCase
{
    use DatabaseTransactions;

    protected $user;

    public function setup(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * @return void
     */
    public function testIndex()
    {
        // ログインしていないとリダイレクトすることを確認
        $response = $this->get('/parts');
        $response->assertStatus(302);

        $response = $this->actingAs($this->user)->get('/parts');
        $response->assertStatus(200)
            ->assertViewIs('parts.index');
    }

    /**
     * @return void
     */
    public function testStore()
    {
        $response = $this->actingAs($this->user)
            ->post(route('parts.store'), [
                'name' => 'testパーツ',
                'supplier_id' => 1,
                'created_user_id' => 1,
                'updated_user_id' => null
            ]);
        $this->assertDatabaseHas('parts', [
            'name' => 'testパーツ'
        ]);
        $response->assertStatus(200)
            ->assertRedirect('/parts');
    }
}
