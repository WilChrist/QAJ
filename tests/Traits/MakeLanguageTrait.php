<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Language;
use App\Repositories\LanguageRepository;

trait MakeLanguageTrait
{
    /**
     * Create fake instance of Language and save it in database
     *
     * @param array $languageFields
     * @return Language
     */
    public function makeLanguage($languageFields = [])
    {
        /** @var LanguageRepository $languageRepo */
        $languageRepo = \App::make(LanguageRepository::class);
        $theme = $this->fakeLanguageData($languageFields);
        return $languageRepo->create($theme);
    }

    /**
     * Get fake instance of Language
     *
     * @param array $languageFields
     * @return Language
     */
    public function fakeLanguage($languageFields = [])
    {
        return new Language($this->fakeLanguageData($languageFields));
    }

    /**
     * Get fake data of Language
     *
     * @param array $languageFields
     * @return array
     */
    public function fakeLanguageData($languageFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $languageFields);
    }
}
