<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Models\Shops\Shops;

class ShopsController extends Controller
{
    /**
     * Request class instance.
     *
     * @var Illuminate\Http\Request
     */
    protected $request;

    /**
     * The ResponseFactory class instance.
     *
     * @var Illuminate\Contracts\Routing\ResponseFactory;
     */
    protected $response;

    /**
     * Shops model instance.
     *
     * @var App\Models\Shops\Shops
     */
    protected $shops;

    /**
     * Create new instances for dependencies.
     *
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Contracts\Routing\ResponseFactory;
     * @param App\Models\Shops\Shops $shops
     * @return void
     */
    public function __construct(Request $request, ResponseFactory $response, Shops $shops)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->shops    = $shops;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->shops->setOffset((int)$this->request->input('offset'));
        $this->shops->setLimit((int)$this->request->input('limit'));
        $this->shops->setSort($this->request->input('sort'));
        $this->shops->setDirection($this->request->input('direction'));

        $shops = $this->shops->all();
        $total = $this->shops->count();
        $meta  = $this->generateResponseMeta($this->shops, $total);

        return $this->response->json($this->formatResponse($type = 'shops', $shops, $meta));
    }

    /**
     * Display a listing of the resource with nested relationships.
     *
     * @param string $relationships
     * @return Response
     */
    public function with($relationships)
    {
        $relationships = explode(',', $relationships);

        $this->shops->setOffset((int)$this->request->input('offset'));
        $this->shops->setLimit((int)$this->request->input('limit'));
        $this->shops->setSort($this->request->input('sort'));
        $this->shops->setDirection($this->request->input('direction'));

        if ($shops = $this->shops->allWith($relationships)) {
            $total = $this->shops->count();
            $meta  = $this->generateResponseMeta($this->shops, $total);
            return $this->response->json($this->formatResponse($type = 'shops', $shops, $meta));
        }

        return $this->response->json($data = [], 400);
    }

    /**
     * Shop a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $this->shops->setOffset(0);
        $this->shops->setLimit(1);

        if ($store = $this->shops->find($id)) {
            $meta = $this->generateResponseMeta($this->shops, $total = 1);
            return $this->response->json($this->formatResponse($type = 'shop', $store, $meta));
        }

        return $this->response->json($data = [], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {

    }
}
