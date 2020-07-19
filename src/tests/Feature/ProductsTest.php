<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class ProductsTest extends TestCase
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
        $response = $this->get('/');
        $response->assertStatus(302);

        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(200)
            ->assertViewIs('home');
    }

    /**
     * @return void
     */
    public function testStore()
    {
        $response = $this->actingAs($this->user)
            ->post('/products', [
                'name' => 'test商品',
                'product_code' => 'SD-KNDJN',
                'created_user_id' => 1,
                'updated_user_id' => 1
            ]);
        $this->assertDatabaseHas('products', [
            'name' => 'test商品'
        ]);
        $response->assertRedirect('/');
    }
}
