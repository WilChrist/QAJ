<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Quote;
use App\Repositories\QuoteRepository;

trait MakeQuoteTrait
{
    /**
     * Create fake instance of Quote and save it in database
     *
     * @param array $quoteFields
     * @return Quote
     */
    public function makeQuote($quoteFields = [])
    {
        /** @var QuoteRepository $quoteRepo */
        $quoteRepo = \App::make(QuoteRepository::class);
        $theme = $this->fakeQuoteData($quoteFields);
        return $quoteRepo->create($theme);
    }

    /**
     * Get fake instance of Quote
     *
     * @param array $quoteFields
     * @return Quote
     */
    public function fakeQuote($quoteFields = [])
    {
        return new Quote($this->fakeQuoteData($quoteFields));
    }

    /**
     * Get fake data of Quote
     *
     * @param array $quoteFields
     * @return array
     */
    public function fakeQuoteData($quoteFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'content' => $fake->text,
            'link_to_the_source' => $fake->word,
            'approuved' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'author_id' => $fake->word,
            'language_id' => $fake->word,
            'user_id' => $fake->word
        ], $quoteFields);
    }
}
