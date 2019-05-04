<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAuthorAPIRequest;
use App\Http\Requests\API\UpdateAuthorAPIRequest;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AuthorController
 * @package App\Http\Controllers\API
 */

class AuthorAPIController extends AppBaseController
{
    /** @var  AuthorRepository */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepo)
    {
        $this->authorRepository = $authorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/authors",
     *      summary="Get a listing of the Authors.",
     *      tags={"Author"},
     *      description="Get all Authors",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Author")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $authors = $this->authorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($authors->toArray(), 'Authors retrieved successfully');
    }

    /**
     * @param CreateAuthorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/authors",
     *      summary="Store a newly created Author in storage",
     *      tags={"Author"},
     *      description="Store Author",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Author that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Author")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Author"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAuthorAPIRequest $request)
    {
        $input = $request->all();

        $author = $this->authorRepository->create($input);

        return $this->sendResponse($author->toArray(), 'Author saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/authors/{id}",
     *      summary="Display the specified Author",
     *      tags={"Author"},
     *      description="Get Author",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Author",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Author"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Author $author */
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            return $this->sendError('Author not found');
        }

        return $this->sendResponse($author->toArray(), 'Author retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAuthorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/authors/{id}",
     *      summary="Update the specified Author in storage",
     *      tags={"Author"},
     *      description="Update Author",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Author",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Author that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Author")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Author"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAuthorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Author $author */
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            return $this->sendError('Author not found');
        }

        $author = $this->authorRepository->update($input, $id);

        return $this->sendResponse($author->toArray(), 'Author updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/authors/{id}",
     *      summary="Remove the specified Author from storage",
     *      tags={"Author"},
     *      description="Delete Author",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Author",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Author $author */
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            return $this->sendError('Author not found');
        }

        $author->delete();

        return $this->sendResponse($id, 'Author deleted successfully');
    }
}
