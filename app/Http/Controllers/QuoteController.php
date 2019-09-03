<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\Language;
use App\Models\Quote;
use App\Repositories\QuoteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class QuoteController extends AppBaseController
{
    /** @var  QuoteRepository */
    private $quoteRepository;

    public function __construct(QuoteRepository $quoteRepo)
    {
        $this->quoteRepository = $quoteRepo;
    }

    /**
     * Display a listing of the Quote.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $quotes = $this->quoteRepository->allWith(['author','language','quoteCategories']);

        $categories=Category::all();

        //dd($data);
        return view('quotes.index')
            ->with('quotes', $quotes);
    }

    /**
     * Show the form for creating a new Quote.
     *
     * @return Response
     */
    public function create()
    {
        $authors=Author::pluck('full_name','id');
        $categories=Category::pluck('name','id');
        $languages=Language::pluck('name','id');
        $quote = new Quote();
        $data=array(
            'authors'=>$authors,
            'categories'=>$categories,
            'languages'=>$languages,
            'quote'=>$quote
        );
        return view('quotes.create')->with('data', $data);
    }

    /**
     * Store a newly created Quote in storage.
     *
     * @param CreateQuoteRequest $request
     *
     * @return Response
     */
    public function store(CreateQuoteRequest $request)
    {
        $input = $request->all();
        $input['user_id']=$request->user()->id;
        //dd($input);

        $quote = $this->quoteRepository->create($input);

        Flash::success('Quote saved successfully.');

        return redirect(route('quotes.index'));
    }

    /**
     * Display the specified Quote.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quote = $this->quoteRepository->findByIdWith($id,['author','language','quoteCategories']);

        if (empty($quote)) {
            Flash::error('Quote not found');

            return redirect(route('quotes.index'));
        }

        return view('quotes.show')->with('quote', $quote);
    }

    /**
     * Show the form for editing the specified Quote.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quote = $this->quoteRepository->find($id);
        $authors=Author::pluck('full_name','id');
        $categories=Category::pluck('name','id');
        $languages=Language::pluck('name','id');

        $data=array(
            'authors'=>$authors,
            'quote'=>$quote,
            'categories'=>$categories,
            'languages'=>$languages
        );
        //dd($data);
        if (empty($quote)) {
            Flash::error('Quote not found');

            return redirect(route('quotes.index'));
        }

        return view('quotes.edit')->with('data', $data);
    }

    /**
     * Update the specified Quote in storage.
     *
     * @param int $id
     * @param UpdateQuoteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuoteRequest $request)
    {
        //dd($request->category_ids);

        $quote = $this->quoteRepository->find($id);

        if (empty($quote)) {
            Flash::error('Quote not found');

            return redirect(route('quotes.index'));
        }
        $quote1=$this->quoteRepository->find($id);
        /*$qc=[];
        foreach ($request->category_ids as $category_id){
            $c=Category::all()->find($category_id);
            array_push($qc,$c);
        }*/
        $quote1->quoteCategories()->sync($request->category_ids);

        //$quote1->save();
//dd($quote1);
        $quote = $this->quoteRepository->update($request->all(), $id);

        Flash::success('Quote updated successfully.');

        return redirect(route('quotes.index'));
    }

    /**
     * Remove the specified Quote from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quote = $this->quoteRepository->find($id);

        if (empty($quote)) {
            Flash::error('Quote not found');

            return redirect(route('quotes.index'));
        }

        $this->quoteRepository->delete($id);

        Flash::success('Quote deleted successfully.');

        return redirect(route('quotes.index'));
    }
}
