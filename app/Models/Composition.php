<?php /** @noinspection PhpUnusedPrivateFieldInspection */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Composition
 *
 * @package App\Models
 *
 * @property int $id Composition unique identifier.
 * @property Composer $composer Composer of this composition.
 * @property string $title Composition title.
 * @property Carbon $createdAt Date of create composition.
 * @property Carbon $updatedAt Date of update composition.
 * @property int composer_id Composer unique identifier.
 *
 * @method static create(array $array)
 * @method static find($trackId)
 */
class Composition extends Model
{
    /**
     * Then name of the "updated at" column.
     */
    public const UPDATED_AT = 'last_played';

    /**
     * Turn off created_at column.
     */
    public const CREATED_AT = null;

    /**
     * The table associated with model.
     *
     * @var string
     */
    protected $table = 'compositions';

    /**
     * The attributes to allow with a mass assigment.
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'composer_id'];

    /**
     * Hide properties for serialization.
     *
     * @var array<string>
     */
    protected $hidden = ['pivot'];

    /**
     * Data types fields in table
     *
     * @var array<string>
     */
    protected $dates = ['last_played'];

    /**
     * Relation with composer model.
     *
     * @return BelongsTo
     */
    public function composer()
    {
        return $this->belongsTo(Composer::class);
    }

    /**
     * Relation with Tag model.
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'composition_tag');
    }
}
