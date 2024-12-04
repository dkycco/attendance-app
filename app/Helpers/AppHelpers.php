<?php

if (!function_exists('getUser')) {
    /**
     * Get user or user's property
     *
     * @param string $key
     * @return \App\Models\User|mixed
     */
    function getUser($key = null)
    {
        $user = request()->user();

        if ($key) {
            return $user->{$key};
        }

        return $user;
    }
}
