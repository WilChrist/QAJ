<?php namespace Tests\Repositories;

use App\Models\Quote;
use App\Repositories\QuoteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeQuoteTrait;
use Tests\ApiTestTrait;

class QuoteRepositoryTest extends TestCase
{
    use MakeQuoteTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuoteRepository
     */
    protected $quoteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->quoteRepo = \App::make(QuoteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_quote()
    {
        $quote = $this->fakeQuoteData();
        $createdQuote = $this->quoteRepo->create($quote);
        $createdQuote = $createdQuote->toArray();
        $this->assertArrayHasKey('id', $createdQuote);
        $this->assertNotNull($createdQuote['id'], 'Created Quote must have id specified');
        $this->assertNotNull(Quote::find($createdQuote['id']), 'Quote with given id must be in DB');
        $this->assertModelData($quote, $createdQuote);
    }

    /**
     * @test read
     */
    public function test_read_quote()
    {
        $quote = $this->makeQuote();
        $dbQuote = $this->quoteRepo->find($quote->id);
        $dbQuote = $dbQuote->toArray();
        $this->assertModelData($quote->toArray(), $dbQuote);
    }

    /**
     * @test update
     */
    public function test_update_quote()
    {
        $quote = $this->makeQuote();
        $fakeQuote = $this->fakeQuoteData();
        $updatedQuote = $this->quoteRepo->update($fakeQuote, $quote->id);
        $this->assertModelData($fakeQuote, $updatedQuote->toArray());
        $dbQuote = $this->quoteRepo->find($quote->id);
        $this->assertModelData($fakeQuote, $dbQuote->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_quote()
    {
        $quote = $this->makeQuote();
        $resp = $this->quoteRepo->delete($quote->id);
        $this->assertTrue($resp);
        $this->assertNull(Quote::find($quote->id), 'Quote should not exist in DB');
    }
}
