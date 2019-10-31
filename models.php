<?php


class User extends Illuminate\Database\Eloquent\Model {}

class Playground extends Illuminate\Database\Eloquent\Model {}

class Image extends Illuminate\Database\Eloquent\Model {

    protected $table = 'images';
    protected $fillable = ['design_id', 'name', 'type', 'image'];

    public function playground()
    {
        return $this->belongsTo('\Models\Playground');
    }
}

?>
