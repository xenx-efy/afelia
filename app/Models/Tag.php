<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Tag
 *
 * @package App\Models
 *
 * @property integer $id Tag unique identifier
 * @property string $title Tag name
 */
class Tag extends Model
{

    /**
     * Disable default timestamps in model.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Attributes allows to mass assigment.
     *
     * @var array<string>
     */
    protected $fillable = ['title'];

    /**
     * Hide properties for serialization.
     *
     * @var array<string>
     */
    protected $hidden = ['pivot'];

    /**
     * Relation with Composition model.
     *
     * @return BelongsToMany
     */
    public function compositions()
    {
        return $this->belongsToMany(Composition::class, 'composition_tag');
    }
}
