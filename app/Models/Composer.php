<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Composer
 * @package App\Models
 * @property integer $id Unique identifier of Composer.
 * @property string $name Name fo Composer.
 */
class Composer extends Model
{
    /**
     * The table associated with model.
     *
     * @var string
     */
    protected $table = 'composers';

    /**
     * Attributes should be mutated to dates.
     *
     * @var string[]
     */
    protected $fillable = ['composer_name'];

    /**
     * Relation with Composition model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function compositions()
    {
        return $this->hasMany(Composition::class, 'id');
    }
}
