<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Adalah class untuk membantu auto complete nya Eloquent
 *
 * @method static $this find($id)
 * @method $this[] get()
 * @method $this first()
 * @method static Builder select()
 * @method static Builder where()
 * @method static Builder whereIn()
 * @method static Builder join()
 * @method static Builder groupBy()
 * @method static Builder whereRaw()
 */
abstract class BaseModel extends Model {
    /**
     * Jika attribute yang diberikan ternyata berisi string kosong,
     * maka return "-". Jika tidak maka return isi attribut itu.
     *
     * @param string $attr
     * @return string
     */
    protected function default($attr) {
        return $this->attributes[$attr] == '' ? '-' : $this->attributes[$attr];
    }
}
