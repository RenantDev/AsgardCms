<?php namespace Modules\Core\Composers;

use Modules\Core\Sidebar\IlluminateSidebarRenderer;
use Modules\Core\Sidebar\AdminSidebar;

class SidebarViewCreator
{
    /**
     * @var AdminSidebar
     */
    protected $sidebar;

    /**
     * @var SidebarRenderer
     */
    protected $renderer;

    /**
     * @param AdminSidebar    $sidebar
     * @param SidebarRenderer $renderer
     */
    public function __construct(AdminSidebar $sidebar, IlluminateSidebarRenderer $renderer)
    {
        $this->sidebar = $sidebar;
        $this->renderer = $renderer;
    }

    public function create($view)
    {
        $view->prefix = config('asgard.core.core.admin-prefix');
        $view->sidebar = $this->renderer->render($this->sidebar, config('asgard.core.core.admin-theme'));
    }
}
