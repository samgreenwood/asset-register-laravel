<?php

namespace App\Http\Controllers;

use App\Entities\Node;
use App\Repositories\NodeRepository;

class NodeController extends Controller
{
    /**
     * @var NodeRepository
     */
    private $nodeRepository;

    /**
     * NodeController constructor.
     * @param NodeRepository $nodeRepository
     */
    public function __construct(NodeRepository $nodeRepository)
    {
        $this->nodeRepository = $nodeRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $nodes = $this->nodeRepository->all();

        return view('nodes.index', compact('nodes'));
    }

    /**
     * @param Node $node
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Node $node)
    {
        $assets = [];

        return view('nodes.show', compact('node', 'assets'));
    }
}
