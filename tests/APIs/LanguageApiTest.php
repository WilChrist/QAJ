<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeLanguageTrait;
use Tests\ApiTestTrait;

class LanguageApiTest extends TestCase
{
    use MakeLanguageTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_language()
    {
        $language = $this->fakeLanguageData();
        $this->response = $this->json('POST', '/api/languages', $language);

        $this->assertApiResponse($language);
    }

    /**
     * @test
     */
    public function test_read_language()
    {
        $language = $this->makeLanguage();
        $this->response = $this->json('GET', '/api/languages/'.$language->id);

        $this->assertApiResponse($language->toArray());
    }

    /**
     * @test
     */
    public function test_update_language()
    {
        $language = $this->makeLanguage();
        $editedLanguage = $this->fakeLanguageData();

        $this->response = $this->json('PUT', '/api/languages/'.$language->id, $editedLanguage);

        $this->assertApiResponse($editedLanguage);
    }

    /**
     * @test
     */
    public function test_delete_language()
    {
        $language = $this->makeLanguage();
        $this->response = $this->json('DELETE', '/api/languages/'.$language->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/languages/'.$language->id);

        $this->response->assertStatus(404);
    }
}
