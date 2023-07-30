<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{
    use HasFactory;

    private static $_items = array();

    protected $fillable = [
        'name',
        'code',
        'type',
        'position'
    ];

    public static function items($type)
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return self::$_items[$type];
    }

    private static function loadItems($type)
    {
        self::$_items[$type] = array();
        $models = Lookup::all()->where('type', $type)->orderBy('position');
        foreach ($models as $model)
            self::$_items[$type][$model->code] = $model->name;
    }

    public static function item($type, $code)
    {
        if (!isset(self::$_items[$type]))
            self::loadItems($type);
        return self::$_items[$type][$code] ?? false;
    }
}
