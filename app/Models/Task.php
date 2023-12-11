<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'created_by_id',
        'assigned_to_id'
    ];

    /**
     * Returns the relationship between the task model and the creator.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * Returns the relationship between the current task model and the User model
     * that the current task model is assigned to.
     *
     * @return BelongsTo The relationship between the current model and User model.
     */
    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    /**
     * Returns the relationship between the current task model and the TaskStatus model
     * that represents the current status of the task.
     *
     * @return BelongsTo The relationship between the current model and TaskStatus model.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    /**
     * Returns the relationship between the current task model and the Label model.
     * This method defines a many-to-many relationship between the current model
     * and the Label model using the pivot table "label_task".
     *
     * @return BelongsToMany The relationship between the current model
     * and the Label model.
     */
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }
}
