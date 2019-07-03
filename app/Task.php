<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'title', 'des', 'file', 'deadline'
    ];
    protected $appends = [
        'status','attachment'
    ];

    public function getStatusAttribute()
    {
        if ($this->pending) {
            return 'Panding';
        }else{
            if ($this->completed) {
                return 'Completed';
            }
            if ($this->fail_deadline) {
                return 'Fail Deadline';
            }
        }
    }
    public function getAttachmentAttribute()
    {
        if($this->file){
            return asset('uploads/'.$this->file);
        }
    }
    public function getDeadlineAttribute()
    {
        if($this->attributes['deadline'] < Carbon::now() && !$this->attributes['completed']){
            $this->attributes['pending'] = false;
            $this->attributes['fail_deadline'] = true;
            $this->save();
        }
        return $this->attributes['deadline'];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
