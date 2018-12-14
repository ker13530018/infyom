<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Repositories\ContentRepository;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ContentController extends AppBaseController
{
    /** @var  ContentRepository */
    private $contentRepository;

    public function __construct(ContentRepository $contentRepo)
    {
        $this->contentRepository = $contentRepo;
    }

    /**
     * Display a listing of the Content.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contentRepository->pushCriteria(new RequestCriteria($request));
        $contents = $this->contentRepository->all();
        $contents = $contents->sortByDesc('id');
        return view('contents.index')
            ->with('contents', $contents);
    }

    /**
     * Show the form for creating a new Content.
     *
     * @return Response
     */
    public function create()
    {
        return view('contents.create');
    }

    /**
     * Store a newly created Content in storage.
     *
     * @param CreateContentRequest $request
     *
     * @return Response
     */
    public function store(CreateContentRequest $request)
    {
        $path = $request->file('og_images')->store('public/upload');

        $input = $request->all();

        $input["og_images"] = str_replace("public", "", $path);

        $content = $this->contentRepository->create($input);

        Flash::success('Content saved successfully.');

        return redirect(route('contents.index'));
    }

    /**
     * Display the specified Content.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        return view('contents.show')->with('content', $content);
    }

    /**
     * Show the form for editing the specified Content.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        return view('contents.edit')->with('content', $content);
    }

    /**
     * Update the specified Content in storage.
     *
     * @param  int              $id
     * @param UpdateContentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContentRequest $request)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }
        
        $all = $request->all();
        if ($request->hasFile('update_og_images')) {
            $path = $request->file('update_og_images')->store('public/upload');
            $all["og_images"] = str_replace("public", "", $path);
        }

        $content = $this->contentRepository->update($all, $id);

        Flash::success('Content updated successfully.');

        return redirect(route('contents.index'));
    }

    /**
     * Remove the specified Content from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            Flash::error('Content not found');

            return redirect(route('contents.index'));
        }

        $this->contentRepository->delete($id);

        Flash::success('Content deleted successfully.');

        return redirect(route('contents.index'));
    }
}
