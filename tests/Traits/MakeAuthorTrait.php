<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Author;
use App\Repositories\AuthorRepository;

trait MakeAuthorTrait
{
    /**
     * Create fake instance of Author and save it in database
     *
     * @param array $authorFields
     * @return Author
     */
    public function makeAuthor($authorFields = [])
    {
        /** @var AuthorRepository $authorRepo */
        $authorRepo = \App::make(AuthorRepository::class);
        $theme = $this->fakeAuthorData($authorFields);
        return $authorRepo->create($theme);
    }

    /**
     * Get fake instance of Author
     *
     * @param array $authorFields
     * @return Author
     */
    public function fakeAuthor($authorFields = [])
    {
        return new Author($this->fakeAuthorData($authorFields));
    }

    /**
     * Get fake data of Author
     *
     * @param array $authorFields
     * @return array
     */
    public function fakeAuthorData($authorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'full_name' => $fake->word,
            'popular_name' => $fake->word,
            'biography' => $fake->text,
            'link_to_full_biography' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $authorFields);
    }
}
