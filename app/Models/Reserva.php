<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reserva
 * 
 * @property int $id
 * @property int $id_user
 * @property int $id_butaca
 * @property Carbon $fecha
 * @property int $numero_personas
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Reserva extends Model
{
	protected $table = 'reservas';

	protected $casts = [
		'id_user' => 'int',
		'id_butaca' => 'int',
		'numero_personas' => 'int'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'id_user',
		'id_butaca',
		'fecha',
		'numero_personas'
	];
}
