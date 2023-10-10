<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Card;


class CardTest extends TestCase
{
    use RefreshDatabase;

    function assert_get_200($response)
    {
        $response->assertStatus(200);
    }

    function assert_card_list_struct($response)
    {
        $response->assertJsonStructure([
            '*' => [
                'project',
                'title',
                'group',
                'title',
                'status',
                'description',
                'id',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    function assert_cout_card_in_list($response, $number){
        $response->assertJsonCount($number);
    }

    public function test_get_cards()
    {
        $cardFatctory = Card::factory()->create();
        $cardFatctory = Card::factory()->create();
        $cardFatctory = Card::factory()->create();


        $response = $this->getJson('/api/cards');

        $this->assert_get_200($response);
        $this->assert_cout_card_in_list($response, 3);
        $this->assert_card_list_struct($response);
    }

    public function test_get_card_id(){
        Card::factory()->create();
        $response = $this->getJson('/api/cards/1');
        $this->assert_get_200($response);
    }




}
