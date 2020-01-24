<?php

namespace App\Policies;

use App\Incidencia;
use App\Profesor;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  \App\Profesor  $user
     * @return mixed
     */
    public function viewAny(Profesor $user)
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Profesor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function editar(Profesor $user, Incidencia $post){
    
       return $user->id == $post->id_profesor; 

    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Profesor  $user
     * @return mixed
     */
    public function create(Profesor $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Profesor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(Profesor $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Profesor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function eliminar(Profesor $user, Incidencia $post)
    {
       return $user->id === $post->id_profesor;

    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\Profesor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(Profesor $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\Profesor  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(Profesor $user, Post $post)
    {
        //
    }
}
