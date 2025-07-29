<?php

namespace Modules\Ladmin\Menus\Submenus;

use Ladmin\Engine\Menus\Gate;
use Ladmin\Engine\Supports\BaseMenu;

class Users extends BaseMenu
{

    /**
     * Gate of default menu
     *
     * @var string
     */
    protected $gate = 'account.index';

    /**
     * Menu title
     *
     * @var string
     */
    protected $name = 'Users';

    /**
     * Menu Font icon
     *
     * @var string
     */
    protected $icon = null;

    /**
     * Menu Description
     *
     * @var string
     */
    protected $description = 'User can access users management';

    /**
     * Status active menu
     *
     * @var string
     */
    protected $isActive = 'user*';

    /**
     * Menu ID
     *
     * @var string
     */
    protected $id = 'users';

    /**
     * Route name
     *
     * @return Array|null
     * @example ['route.name', ['uuid', 'foo' => 'bar']]
     */
    protected function route(): ?array
    {
        return ['ladmin.user.index'];
    }

    /**
     * Other gates
     *
     * @return Array(Ladmin\Engine\Menus\Gate)
     */
    protected function gates()
    {
        return [
            new Gate(gate: 'ladmin.user.create', title: 'Create New User', description: 'User can create new user account'),
            new Gate(gate: 'ladmin.user.edit', title: 'Update User', description: 'User can update user account'),
            new Gate(gate: 'ladmin.user.delete', title: 'Delete User', description: 'User can delete user account'),
        ];
    }

    /**
     * Submenu
     *
     * @return void
     */
    protected function submenus()
    {
        return [];
    }
}
