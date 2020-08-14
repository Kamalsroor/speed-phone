<?php
    // if auth in table comp_users and admin
    Blade::if('cadmin', function ($userCheck = null) {
        $userCheck = auth()->guard('comp_user')->check() && auth()->guard('comp_user')->user()->rule == 1;
        return $userCheck;
    });

    // if auth in table comp_users and user
    Blade::if('cuser', function ($userCheck = null) {
        $userCheck = auth()->guard('comp_user')->check() && auth()->guard('comp_user')->user()->rule == 0;
        return $userCheck;
    });