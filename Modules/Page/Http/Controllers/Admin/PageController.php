<?php

namespace Modules\Page\Http\Controllers\Admin;

use Breadcrumbs;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Page\Entities\Page;
use Modules\Page\Http\Requests\CreatePageRequest;
use Modules\Page\Http\Requests\UpdatePageRequest;
use Modules\Page\Repositories\PageRepository;
use URL;

class PageController extends AdminBaseController
{
    /**
     * @var PageRepository
     */
    private $page;

    public function __construct(PageRepository $page)
    {
        parent::__construct();

        $this->page = $page;
        $this->assetPipeline->requireCss('icheck.blue.css');

        Breadcrumbs::addCrumb(trans('page::pages.title.pages'), URL::route('admin.page.page.index'));
    }

    public function index()
    {
        $pages = $this->page->all();

        return view('page::admin.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Breadcrumbs::addCrumb(trans('page::pages.title.create page'));

        return view('page::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePageRequest $request
     *
     * @return Response
     */
    public function store(CreatePageRequest $request)
    {
        $this->page->create($request->all());

        flash(trans('page::messages.page created'));

        return redirect()->route('admin.page.page.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     *
     * @return Response
     */
    public function edit(Page $page)
    {
        Breadcrumbs::addCrumb(trans('page::pages.title.edit page'));

        $this->assetPipeline->requireJs('ckeditor.js');
        $this->assetPipeline->requireCss('icheck.blue.css');

        return view('page::admin.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Page              $page
     * @param UpdatePageRequest $request
     *
     * @return Response
     */
    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->page->update($page, $request->all());

        flash(trans('page::messages.page updated'));

        return redirect()->route('admin.page.page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     *
     * @return Response
     */
    public function destroy(Page $page)
    {
        $this->page->destroy($page);

        flash(trans('page::messages.page deleted'));

        return redirect()->route('admin.page.page.index');
    }
}
