<?php

namespace Alexwenzel\DependencyContainer\Http\Controllers;

use Alexwenzel\DependencyContainer\ActionHasDependencies;
use Alexwenzel\DependencyContainer\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Controllers\ActionController as NovaActionController;
use Laravel\Nova\Http\Requests\ActionRequest as NovaActionRequest;

class ActionController extends NovaActionController
{
    /**
     * create custom request from base Nova ActionRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function store(NovaActionRequest $request): mixed
    {
        $action = $request->action();

        if (in_array(ActionHasDependencies::class, class_uses_recursive($action))) {
            $request = ActionRequest::createFrom($request);
        }

        return parent::store($request);
    }
}
