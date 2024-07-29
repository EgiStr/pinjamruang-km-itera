<?php

namespace App\Models;

use App\Enums\ApprovalStatus;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowRoom extends Model
{
    use SoftDeletes;

    protected $table = 'borrow_rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'borrower_id',
        'room_id',
        'borrow_at',
        'until_at',
        'admin_id',
        'admin_approval_status',
        'finished_at',
        'notes',
        'surat_peminjaman',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [];

    /**
     * Relationship
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function borrower()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function admin()
    {
        return $this->belongsTo(Administrator::class);
    }

    /**
     * Scope
     *
     */
    public function scopeIsNotFinished($query)
    {
        return $query->where('admin_approval_status', '!=', 2)->where('finished_at', '=', null);
    }

    public function scopeIsAdminApproval($query)
    {
        return $query->where('admin_approval_status', '=', ApprovalStatus::Disetujui());
    }

    /**
     * Accessor
     */


    /**
     * Mutators
     */
}
