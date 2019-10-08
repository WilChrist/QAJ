<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Repositories\AuthorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Traits\UploadTrait;
use Flash;
use Response;

class AuthorController extends AppBaseController
{
    use UploadTrait;

    /** @var  AuthorRepository */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepo)
    {
        $this->authorRepository = $authorRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Author.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $authors = $this->authorRepository->all();

        return view('authors.index')
            ->with('authors', $authors);
    }

    /**
     * Show the form for creating a new Author.
     *
     * @return Response
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created Author in storage.
     *
     * @param CreateAuthorRequest $request
     *
     * @return Response
     */
    public function store(CreateAuthorRequest $request)
    {
        $input = $request->all();
        $filePath = $this->uploadImage($request);
        if($filePath!=null){
            // Set image path in database to filePath
            $input['image_url'] = $filePath;
        }


        $author = $this->authorRepository->create($input);

        Flash::success('Author saved successfully.');

        return redirect(route('authors.index'));
    }

    /**
     * Display the specified Author.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('authors.index'));
        }

        return view('authors.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified Author.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('authors.index'));
        }

        return view('authors.edit')->with('author', $author);
    }

    /**
     * Update the specified Author in storage.
     *
     * @param int $id
     * @param UpdateAuthorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuthorRequest $request)
    {
        $author = $this->authorRepository->find($id);
//dd($author);
        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('authors.index'));
        }

        $filePath = $this->uploadImage($request);//dd($request);
        $input = $request->all();
        if($filePath!=null){
            // Set image path in database to filePath
            $input['image_url'] = $filePath;
        }else{
            $input['image_url'] = $author->image_url;
        }

        $author = $this->authorRepository->update($input, $id);

        Flash::success('Author updated successfully.');

        return redirect(route('authors.index'));
    }

    /**
     * Remove the specified Author from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $author = $this->authorRepository->find($id);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('authors.index'));
        }

        $this->authorRepository->delete($id);

        Flash::success('Author deleted successfully.');

        return redirect(route('authors.index'));
    }

    /**
     * Upload the image, store it and return the path.
     *
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return string
     */
    public function uploadImage($request)
    {
        // Form validation

        $filePath=null;
        //dd($request->file('image_url'));
        // Check if a image has been uploaded
        if ($request->has('image_url') && $request->file('image_url')!=null) {
            $request->validate([
                'image_url'     =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
                ]);
            // Get image file
            $image = $request->file('image_url');
            // Make a image name based on popular_name and current timestamp
            $name = Str::slug($request->input('popular_name')).'_'.time();
            // Define folder path
            $folder = '/img/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
        }
        return $filePath;
    }
}
