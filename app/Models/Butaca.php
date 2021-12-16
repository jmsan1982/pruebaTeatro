<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Butaca
 * 
 * @property int $id
 * @property string $fila
 * @property int $columna
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Butaca extends Model
{
	protected $table = 'butacas';

	protected $casts = [
		'columna' => 'int'
	];

	protected $fillable = [
		'fila',
		'columna'
	];
}
