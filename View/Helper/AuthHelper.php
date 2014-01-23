<?php

App::uses('AppHelper', 'View/Helper');

class AuthHelper extends AppHelper {

    public function user($key = null) {
        return AuthComponent::user($key);
    }

}
