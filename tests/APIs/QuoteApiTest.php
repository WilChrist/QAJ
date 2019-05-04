<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeQuoteTrait;
use Tests\ApiTestTrait;

class QuoteApiTest extends TestCase
{
    use MakeQuoteTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_quote()
    {
        $quote = $this->fakeQuoteData();
        $this->response = $this->json('POST', '/api/quotes', $quote);

        $this->assertApiResponse($quote);
    }

    /**
     * @test
     */
    public function test_read_quote()
    {
        $quote = $this->makeQuote();
        $this->response = $this->json('GET', '/api/quotes/'.$quote->id);

        $this->assertApiResponse($quote->toArray());
    }

    /**
     * @test
     */
    public function test_update_quote()
    {
        $quote = $this->makeQuote();
        $editedQuote = $this->fakeQuoteData();

        $this->response = $this->json('PUT', '/api/quotes/'.$quote->id, $editedQuote);

        $this->assertApiResponse($editedQuote);
    }

    /**
     * @test
     */
    public function test_delete_quote()
    {
        $quote = $this->makeQuote();
        $this->response = $this->json('DELETE', '/api/quotes/'.$quote->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/quotes/'.$quote->id);

        $this->response->assertStatus(404);
    }
}
