<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Composer
 * @package App\Models
 * @property integer $id Unique identifier of Composer.
 * @property string $name Name fo Composer.
 */
class Composer extends Model
{

    public $timestamps = false;
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
     * @return HasMany
     */
    public function compositions()
    {
        return $this->hasMany(Composition::class, 'id');
    }
}
