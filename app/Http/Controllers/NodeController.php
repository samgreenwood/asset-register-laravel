<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Entities\Node;
use App\Repositories\NodeRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

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

        $assets = collect(EntityManager::getRepository(Asset::class)->findAll());
        
        $nodes = collect($this->nodeRepository->all())->map(function(Node $node) use($assets) {
            $node->setAssets($assets->filter(function(Asset $asset) use($node) {
                return $asset->currentLocation() == $node;
            }));

            return $node;
        });

        return view('nodes.index', compact('nodes'));
    }

    /**
     * @param Node $node
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Node $node)
    {
        $assets = collect(EntityManager::getRepository(Asset::class)->findAll())->filter(function(Asset $asset) use($node) {
            return $asset->currentLocation() == $node;
        });

        return view('nodes.show', compact('node', 'assets'));
    }
}
