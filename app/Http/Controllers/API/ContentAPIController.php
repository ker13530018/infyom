<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateContentAPIRequest;
use App\Http\Requests\API\UpdateContentAPIRequest;
use App\Models\Content;
use App\Repositories\ContentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ContentController
 * @package App\Http\Controllers\API
 */

class ContentAPIController extends AppBaseController
{
    /** @var  ContentRepository */
    private $contentRepository;

    public function __construct(ContentRepository $contentRepo)
    {
        $this->contentRepository = $contentRepo;
    }

    /**
     * Display a listing of the Content.
     * GET|HEAD /contents
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contentRepository->pushCriteria(new RequestCriteria($request));
        $this->contentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $contents = $this->contentRepository->all();

        return $this->sendResponse($contents->toArray(), 'Contents retrieved successfully');
    }

    /**
     * Store a newly created Content in storage.
     * POST /contents
     *
     * @param CreateContentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContentAPIRequest $request)
    {
        $input = $request->all();

        $contents = $this->contentRepository->create($input);

        return $this->sendResponse($contents->toArray(), 'Content saved successfully');
    }

    /**
     * Display the specified Content.
     * GET|HEAD /contents/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Content $content */
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            return $this->sendError('Content not found');
        }

        return $this->sendResponse($content->toArray(), 'Content retrieved successfully');
    }

    /**
     * Update the specified Content in storage.
     * PUT/PATCH /contents/{id}
     *
     * @param  int $id
     * @param UpdateContentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Content $content */
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            return $this->sendError('Content not found');
        }

        $content = $this->contentRepository->update($input, $id);

        return $this->sendResponse($content->toArray(), 'Content updated successfully');
    }

    /**
     * Remove the specified Content from storage.
     * DELETE /contents/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Content $content */
        $content = $this->contentRepository->findWithoutFail($id);

        if (empty($content)) {
            return $this->sendError('Content not found');
        }

        $content->delete();

        return $this->sendResponse($id, 'Content deleted successfully');
    }
}
