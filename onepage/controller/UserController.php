<?php

namespace Onepage\Controller;

use Onepage\View\Backend;
use Onepage\User;
use Onepage\Request;

class UserController {
    public function getLogin() {
        Backend::make('login');
    }

    public function postLogin() {
        $request = Request::all();
        $user = User::get()->login($request['username'], $request['password']);
        if($user === true) {
            redirect(route('admin'));
        }
        redirect(route(login));
    }

    public function getLogout() {
        User::get()->logout();
        return redirect(route('home'));
    }
}