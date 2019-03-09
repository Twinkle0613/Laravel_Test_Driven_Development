<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    /**
     *
     * @test
     */
    public function can_create_a_product()
    {
        $faker = Factory::create();
        
        $response = $this->json('POST','/api/products',[
            'name' => $name = $faker->company,
            'slug' => str_slug($name),
            'price' => $price = random_int(10,100)
        ]);
        
        \Log::info(1,[$response->getContent()]);

        $response->assertJsonStructure([
            'id','name','slug','price',
        ])
        ->assertJson([
            'name'=> $name,
            'slug' => str_slug($name),
            'price' => $price
        ])
        ->assertStatus(201);

        $this->assertDatabaseHas('products',[
            'name' =>$name,
            'slug' => str_slug($name),
            'price' => $price
        ]);
        
    }

     /**
     *
     * @test
     */
    public function can_return_a_product()
    {
        $product = $this->create('Product');
        \Log::info(1,[$product]);

        $response = $this->json('GET',"api/products/$product->id");
        \Log::info(1,[$response->json()]);

        $response->assertStatus(200);
    }


}
