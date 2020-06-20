<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Tag
 * @package App\Models
 *
 */
class Tag extends Model
{
    /**
     * The table associated with model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * Attributes allows to mass assigment.
     *
     * @var string[]
     */
    protected $fillable = ['title'];

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
