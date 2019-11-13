<?php

namespace App\Models;


class Role extends Base 
{
    public function nodes()
    {
        return $this->belongsToMany(Node::class,'role_node','role_id','node_id');
    }
}
