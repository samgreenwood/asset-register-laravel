<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Repositories\MemberRepository;
use App\Repositories\NodeRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AssetController extends Controller
{
    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * @var NodeRepository
     */
    private $nodeRepository;
    
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * AssetController constructor.
     * @param MemberRepository $memberRepository
     * @param NodeRepository $nodeRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(MemberRepository $memberRepository, NodeRepository $nodeRepository, ProductRepository $productRepository)
    {
        $this->memberRepository = $memberRepository;
        $this->nodeRepository = $nodeRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = EntityManager::getRepository(Asset::class)->findAll();
        
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->all()->mapWithKeys(function($product) {
            return [$product->uuid() => $product->fullName()];
        });

        $nodes = $this->nodeRepository->all()->mapWithKeys(function($node) {
            return [$node->uuid() => $node->name()];
        });

        $members = $this->memberRepository->all()->mapWithKeys(function($member) {
            return [$member->uuid() => $member->name()];
        });

        return view('assets.create', compact('products', 'nodes', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'purchase_reference' => 'required',
            'purchased_date' => 'required|date',
            'assignable_type' => 'required',
            'assignable_id' => 'required',
            'serial' => 'required'
        ]);
        
        $product = $this->productRepository->findById($request->input('product_id'));
        $assignable = null;

        switch(request('assignable_type'))
        {
            case 'member':
                $assignable = $this->memberRepository->findById($request->input('assignable_id'));
                break;
            case 'node':
                $assignable = $this->nodeRepository->findById($request->input('assignable_id'));
                break;
        }

        $asset = new Asset(
            $product,
            $request->input('purchase_reference'),
            new \DateTimeImmutable($request->input('purchased_date')),
            $request->input('serial')
        );

        $asset->assign($assignable, auth()->user()->member(), $request->input('notes') ?? 'None');

        EntityManager::persist($asset);
        EntityManager::flush();

        return redirect()->route('assets.show', $asset->id());
    }

    /**
     * Display the specified resource.
     *
     * @param  Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }
}
