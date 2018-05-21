<?php
    namespace App\Http\Controllers;
    use App\Repositories\ImageRepository;
    class AdminController extends Controller
    {
        protected $repository;
        public function __construct(ImageRepository $repository)
        {
            $this->repository = $repository;
        }
        public function index()
        {
            $orphans = $this->repository->getOrphans ();
            $countOrphans = count($orphans);
            return view('maintenance.index', compact ('orphans', 'countOrphans'));
        }
        public function destroy()
        {
            $this->repository->destroyOrphans ();
            return response()->json();
        }
    }