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
        $users = Card::factory()->count(3)->create();


        $response = $this->getJson('/api/cards');

        $this->assert_get_200($response);
        $this->assert_cout_card_in_list($response, 3);
        $this->assert_card_list_struct($response);
    }

    public function test_get_cards_order_by_project_group(){
        
        $itens = Card::factory()->count(10)->create();

        $response = $this->get('/api/cards');
        $response->assertStatus(200);
        $response->assertJsonCount(10);

        $lastProject = '';
        $lastGroup = '';
        foreach ($response->json() as $item) {
            if (strcasecmp($item['project'], $lastProject) > 0) {
                $this->assertGreaterThanOrEqual($lastProject, $item['project']);
            } 

            if (strcasecmp($item['group'], $lastGroup) > 0) {
                $this->assertGreaterThanOrEqual($lastGroup, $item['group']);
            } 

            $lastProject = $item['project'];
            $lastGroup = $item['group'];
        }

    }

    public function test_get_card_id(){
       $card = Card::factory()->create();

        $response = $this->getJson("/api/cards/{$card['id']}");
        $response->assertStatus(200);
    }

    public function test_post_cards(){

        $response = $this->postJson('/api/cards', [
            'project'=>'fgsdfg',
            'group'=>'fgsdfg',
            'title'=>'fgsdfg',
            'status'=>'fgsdfg',
            'description'=>'fgsdfg',
        ]);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_put_card_id(){
        $cardFatctory = Card::factory()->create();
        
        $response = $this->putJson('/api/cards/1',[
            'project'=>'fgsdfg',
            'group'=>'fgsdfg',
            'title'=>'fgsdfg',
            'status'=>'fgsdfg',
            'description'=>'fgsdfg',
        ]);
        
        $this->assertEquals(200, $response->getStatusCode());
    }



}
