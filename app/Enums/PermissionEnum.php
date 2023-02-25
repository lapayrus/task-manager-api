<?php

namespace App\Enums;

enum PermissionEnum : string
{
    // Tasks
    case CREATE_TASK = 'create tasks';
    case EDIT_TASK = 'edit tasks';
    case VIEW_TASK = 'view tasks';
    case DELETE_TASK = 'delete tasks';
    case EDIT_ALL_TASK = 'edit all tasks';
    case VIEW_ALL_TASK = 'view all tasks';
    case DELETE_ALL_TASK = 'delete all tasks';
}