<?php


namespace App\Traits;


use App\Activity;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                if (auth()->guest()) return;
                $model->recordActivity($event);
            });
        }
    }

    protected static function getActivitiesToRecord()
    {
        return ['created'];
    }

    /**
     *  Get all the model's activities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Record activity.
     *
     * @param $event
     * @throws \ReflectionException
     */
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
        ]);
    }

    /**
     * Return event type for the activity.
     *
     * @param string $event
     * @return string
     */
    protected function getActivityType(string $event): string
    {
        $type = strtolower(class_basename($this));

        return "{$event}_{$type}";
    }
}