<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Part;

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
            ->post('/parts', [
                'name' => 'testパーツ',
                'supplier_id' => 1
            ]);
        $this->assertDatabaseHas('parts', [
            'name' => 'testパーツ'
        ]);
        $response->assertRedirect('/parts');
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $part = factory(Part::class)->create();
        $response = $this->actingAs($this->user)
            ->put("/parts/{$part->id}", [
                'name' => 'testパーツ',
                'supplier_id' => 2
            ]);
        $this->assertDatabaseHas('parts', [
            'name' => 'testパーツ',
            'supplier_id' => 2
        ]);
        $response->assertRedirect("/parts/{$part->id}");
    }
}
