<?php

namespace evidenceekanem\laravelTodoList\Facades;

use Illuminate\Support\Facades\Facade;

class laravelTodoList extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laraveltodolist';
    }
}
