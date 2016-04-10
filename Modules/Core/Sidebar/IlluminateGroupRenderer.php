<?php

namespace Modules\Core\Sidebar;

use Illuminate\Contracts\View\Factory;
use Maatwebsite\Sidebar\Group;

class IlluminateGroupRenderer
{
    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @var string
     */
    protected $view = 'sidebar-theme::group';

    /**
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Group $group
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(Group $group)
    {
        if ($group->isAuthorized()) {
            $items = [];
            foreach ($group->getItems() as $item) {
                $items[] = (new IlluminateItemRenderer($this->factory))->render($item);
            }

            return $this->factory->make($this->view, [
                'group' => $group,
                'items' => $items
            ])->render();
        }
    }
}
