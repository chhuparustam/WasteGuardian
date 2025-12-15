<?php

namespace App\Http\Traits;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Log user activity
     *
     * @param string $type
     * @param string $description
     * @param int|null $userId
     * @return \App\Models\Activity
     */
    protected function logActivity($type, $description, $userId = null)
    {
        return Activity::create([
            'user_id' => $userId ?? Auth::id(),
            'type' => $type,
            'description' => $description,
        ]);
    }

    /**
     * Log request creation activity
     *
     * @param int|null $userId
     * @return \App\Models\Activity
     */
    protected function logRequestCreated($userId = null)
    {
        return $this->logActivity('request_created', 'New waste collection request submitted', $userId);
    }

    /**
     * Log request update activity
     *
     * @param int|null $userId
     * @return \App\Models\Activity
     */
    protected function logRequestUpdated($userId = null)
    {
        return $this->logActivity('request_updated', 'Waste collection request updated', $userId);
    }

    /**
     * Log request deletion activity
     *
     * @param int|null $userId
     * @return \App\Models\Activity
     */
    protected function logRequestDeleted($userId = null)
    {
        return $this->logActivity('request_deleted', 'Waste collection request deleted', $userId);
    }

    /**
     * Log complaint creation activity
     *
     * @param string $subject
     * @param int|null $userId
     * @return \App\Models\Activity
     */
    protected function logComplaintCreated($subject, $userId = null)
    {
        return $this->logActivity('complaint', "Complaint Created: {$subject}", $userId);
    }

    /**
     * Log complaint deletion activity
     *
     * @param string $subject
     * @param int|null $userId
     * @return \App\Models\Activity
     */
    protected function logComplaintDeleted($subject, $userId = null)
    {
        return $this->logActivity('complaint_deleted', "Complaint Deleted: {$subject}", $userId);
    }
}
