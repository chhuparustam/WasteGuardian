<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait AuthorizesOwnership
{
    /**
     * Check if the authenticated user owns the resource
     *
     * @param mixed $resource
     * @param string $ownerField
     * @return bool
     */
    protected function authorizeOwnership($resource, $ownerField = 'user_id')
    {
        return $resource->{$ownerField} === Auth::id();
    }

    /**
     * Redirect back with unauthorized error if ownership check fails
     *
     * @param mixed $resource
     * @param string $ownerField
     * @param string $errorMessage
     * @return \Illuminate\Http\RedirectResponse|null
     */
    protected function ensureOwnership($resource, $ownerField = 'user_id', $errorMessage = 'You are not authorized to perform this action.')
    {
        if (!$this->authorizeOwnership($resource, $ownerField)) {
            return redirect()->back()->with('error', $errorMessage);
        }

        return null;
    }

    /**
     * Check if user is authenticated
     *
     * @param string $errorMessage
     * @return \Illuminate\Http\RedirectResponse|null
     */
    protected function ensureAuthenticated($errorMessage = 'You must be logged in to perform this action.')
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', $errorMessage);
        }

        return null;
    }
}
