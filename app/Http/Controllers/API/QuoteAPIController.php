<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuoteAPIRequest;
use App\Http\Requests\API\UpdateQuoteAPIRequest;
use App\Models\Quote;
use App\Repositories\QuoteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class QuoteController
 * @package App\Http\Controllers\API
 */

class QuoteAPIController extends AppBaseController
{
    /** @var  QuoteRepository */
    private $quoteRepository;

    public function __construct(QuoteRepository $quoteRepo)
    {
        $this->quoteRepository = $quoteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/quotes",
     *      summary="Get a listing of the Quotes.",
     *      tags={"Quote"},
     *      description="Get all Quotes",
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
     *                  @SWG\Items(ref="#/definitions/Quote")
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
        $quotes = $this->quoteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($quotes->toArray(), 'Quotes retrieved successfully');
    }

    /**
     * @param CreateQuoteAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/quotes",
     *      summary="Store a newly created Quote in storage",
     *      tags={"Quote"},
     *      description="Store Quote",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Quote that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Quote")
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
     *                  ref="#/definitions/Quote"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateQuoteAPIRequest $request)
    {
        $input = $request->all();

        $quote = $this->quoteRepository->create($input);

        return $this->sendResponse($quote->toArray(), 'Quote saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/quotes/{id}",
     *      summary="Display the specified Quote",
     *      tags={"Quote"},
     *      description="Get Quote",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Quote",
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
     *                  ref="#/definitions/Quote"
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
        /** @var Quote $quote */
        $quote = $this->quoteRepository->find($id);

        if (empty($quote)) {
            return $this->sendError('Quote not found');
        }

        return $this->sendResponse($quote->toArray(), 'Quote retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateQuoteAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/quotes/{id}",
     *      summary="Update the specified Quote in storage",
     *      tags={"Quote"},
     *      description="Update Quote",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Quote",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Quote that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Quote")
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
     *                  ref="#/definitions/Quote"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateQuoteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Quote $quote */
        $quote = $this->quoteRepository->find($id);

        if (empty($quote)) {
            return $this->sendError('Quote not found');
        }

        $quote = $this->quoteRepository->update($input, $id);

        return $this->sendResponse($quote->toArray(), 'Quote updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/quotes/{id}",
     *      summary="Remove the specified Quote from storage",
     *      tags={"Quote"},
     *      description="Delete Quote",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Quote",
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
        /** @var Quote $quote */
        $quote = $this->quoteRepository->find($id);

        if (empty($quote)) {
            return $this->sendError('Quote not found');
        }

        $quote->delete();

        return $this->sendResponse($id, 'Quote deleted successfully');
    }
}
