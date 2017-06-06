<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Repositories\MemberRepository;
use App\Repositories\NodeRepository;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ReassignAssetController extends Controller
{
    /**
     * @var NodeRepository
     */
    private $nodeRepository;

    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * ReassignAssetController constructor.
     * @param NodeRepository $nodeRepository
     * @param MemberRepository $memberRepository
     */
    public function __construct(NodeRepository $nodeRepository, MemberRepository $memberRepository)
    {
        $this->nodeRepository = $nodeRepository;
        $this->memberRepository = $memberRepository;
    }

    /**
     * @param Asset $asset
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Asset $asset)
    {
        $nodes = $this->nodeRepository->all()->mapWithKeys(function($node) {
            return [$node->uuid() => $node->name()];
        });

        $members = $this->memberRepository->all()->mapWithKeys(function($member) {
            return [$member->uuid() => $member->name()];
        });

        return view('assets.reassign', compact('asset', 'nodes', 'members'));
    }

    /**
     * @param Asset $asset
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Asset $asset, Request $request)
    {
        $location = $this->nodeRepository->findById($request->input('assignable_id')) ??
                    $this->memberRepository->findById($request->input('assignable_id'));

        $asset->assign(
            $location,
            $request->user()->member(),
            $request->input('notes') ?? 'NA'
        );

        EntityManager::persist($asset);
        EntityManager::flush();

        return redirect()->route('assets.show', $asset->id());
    }
}