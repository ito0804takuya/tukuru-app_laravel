<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\User;
use App\Product;
use Illuminate\Support\Str;

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
        \Storage::fake('files');
        $file = UploadedFile::fake()->image('test.jpg');
        $name = Str::random(10);
        $response = $this->actingAs($this->user)
            ->post('/products', [
                'name' => $name,
                'product_code' => 'SD-KNDJN',
                'image' => $file
            ]);
        $this->assertDatabaseHas('products', [
            'name' => $name
        ]);
        $response->assertRedirect('/');
    }

    /**
     * @return void
     */
    public function testDestroy()
    {
        $product = factory(Product::class)->create();
        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);
        $response = $this->actingAs($this->user)
            ->delete('/products/' . $product->id);
        $response->assertRedirect('/');
        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
        
    }
}
