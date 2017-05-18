<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Models\Stores\Stores;

class StoresController extends Controller
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
     * Stores model instance.
     *
     * @var App\Models\Stores\Stores
     */
    protected $stores;

    /**
     * Create new instances for dependencies.
     *
     * @param Illuminate\Http\Request $request
     * @param Illuminate\Contracts\Routing\ResponseFactory;
     * @param App\Models\Stores\Stores $stores
     * @return void
     */
    public function __construct(Request $request, ResponseFactory $response, Stores $stores)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->stores   = $stores;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->stores->setOffset((int)$this->request->input('offset'));
        $this->stores->setLimit((int)$this->request->input('limit'));
        $this->stores->setSort($this->request->input('sort'));
        $this->stores->setDirection($this->request->input('direction'));

        $stores = $this->stores->all();
        $total  = $this->stores->count();
        $meta   = $this->generateResponseMeta($this->stores, $total);

        return $this->response->json($this->formatResponse($type = 'stores', $stores, $meta));
    }

    /**
     * Display a listing of the resource with nested relationships.
     *
     * @param string $relationships
     *
     * @return Response
     */
    public function with($relationships)
    {

    }

    /**
     * Store a newly created resource in storage.
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
     *
     * @return Response
     */
    public function show($id)
    {
        $this->stores->setOffset(0);
        $this->stores->setLimit(1);

        if ($store = $this->stores->find($id)) {
            $meta = $this->generateResponseMeta($this->stores, $total = 1);
            return $this->response->json($this->formatResponse($type = 'store', $store, $meta));
        }

        return $this->response->json($data = [], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

    }
}
