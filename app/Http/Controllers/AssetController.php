<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Entities\Assignment;
use App\Entities\Product;
use App\Repositories\MemberRepository;
use App\Repositories\NodeRepository;
use Illuminate\Http\Request;

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
     * AssetController constructor.
     */
    public function __construct(MemberRepository $memberRepository, NodeRepository $nodeRepository)
    {
        $this->memberRepository = $memberRepository;
        $this->nodeRepository = $nodeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::all();
        
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::pluck('name', 'id');

        $nodes = $this->nodeRepository->all()->mapWithKeys(function($node) {
            return [$node->uuid => $node->name];
        });

        $members = $this->memberRepository->all()->mapWithKeys(function($member) {
            return [$member->uuid => $member->name];
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
            'purchase_date' => 'required|date',
            'assignment_type' => 'required',
            'assignment_id' => 'required'
        ]);

        $asset = Asset::create([
            'product_id' => $request->input('product_id'),
            'purchase_date' => $request->input('purchase_date'),
            'purchase_reference' => $request->input('purchase_reference'),
        ]);

        $assignment = new Assignment([
            'assignable_type' => $request->input('assignment_type'),
            'assignable_id' => $request->input('assignable_id'),
            'assignment_date' => $request->input('assignment_date')
        ]);

        $asset->assignments()->save($assignment);


    }

    /**
     * Display the specified resource.
     *
     * @param  Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
    }
}