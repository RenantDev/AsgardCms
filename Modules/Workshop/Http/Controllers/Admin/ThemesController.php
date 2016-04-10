<?php namespace Modules\Workshop\Http\Controllers\Admin;

use FloatingPoint\Stylist\Theme\Theme;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Workshop\Manager\ThemeManager;
use Breadcrumbs;

class ThemesController extends AdminBaseController
{
    /**
     * @var ThemeManager
     */
    private $themeManager;

    public function __construct(ThemeManager $themeManager)
    {
        parent::__construct();

        $this->themeManager = $themeManager;

        Breadcrumbs::addCrumb(trans('workshop::themes.breadcrumb.themes'), route('admin.workshop.themes.index'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $themes = $this->themeManager->all();

        return view('workshop::admin.themes.index', compact('themes'));
    }

    /**
     * @param Theme $theme
     * @return \Illuminate\View\View
     */
    public function show(Theme $theme)
    {
        Breadcrumbs::addCrumb(trans('workshop::themes.viewing theme', ['theme' => $theme->getName()]));

        return view('workshop::admin.themes.show', compact('theme'));
    }
}
