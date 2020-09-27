<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Composer
 *
 * @package App\Models
 *
 * @property int $id Unique identifier of Composer.
 * @property string $name Name fo Composer.
 * @method static get()
 * @method static create(array $array)
 * @method static find(int $composerId)
 */
class Composer extends Model
{

    /**
     * Disable timestamps in this model.
     *
     * @var bool
     */
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
     * @var array<string>
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
