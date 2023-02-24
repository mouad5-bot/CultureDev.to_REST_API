<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addArticle='add article';
        $editAllActicle = 'edit All article';
        $editMyActicle = 'edit My article';
        $deleteAllActicle = 'delete All article';
        $deleteMyActicle = 'delete My article';
        $viewArticle='view articles';

        $addCategory='add category';
        $editCategory='edit category';
        $deleteCategory='delete category';
        $viewCategory='view category';

        $viewComment='view comment';
        $addComment='add comment';
        $editComments='edit comments';
        $editComment='edit comment';
        $deleteComments='delete comments';
        $deleteComment='delete comment';

        $addTag='add tag';
        $editTag='edit tag';
        $deleteTag='delete tag';
        $viewTag='view tag';

        $viewUsers='view users';
        $viewUser='view user';
        $editUsers='edit users';
        $editUser='edit user';
        $deleteUsers='delete users';
        $deleteUser='delete user';

         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => $addArticle]);
        Permission::create(['name' => $editAllActicle]);
        Permission::create(['name' => $editMyActicle]);
        Permission::create(['name' => $deleteAllActicle]);
        Permission::create(['name' => $deleteMyActicle]);
        Permission::create(['name' => $viewArticle]);

        Permission::create(['name' => $addCategory]);
        Permission::create(['name' => $editCategory]);
        Permission::create(['name' => $deleteCategory]);
        Permission::create(['name' => $viewCategory]);

        Permission::create(['name' => $viewComment]);
        Permission::create(['name' => $addComment]);
        Permission::create(['name' => $editComments]);
        Permission::create(['name' => $editComment]);
        Permission::create(['name' => $deleteComments]);
        Permission::create(['name' => $deleteComment]);

        Permission::create(['name' => $addTag]);
        Permission::create(['name' => $editTag]);
        Permission::create(['name' => $deleteTag]);
        Permission::create(['name' => $viewTag]);

        Permission::create(['name' => $viewUsers]);
        Permission::create(['name' => $viewUser]);
        Permission::create(['name' => $editUsers]);
        Permission::create(['name' => $editUser]);
        Permission::create(['name' => $deleteUsers]);
        Permission::create(['name' => $deleteUser]);

        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'author'])->givePermissionTo([
            $addArticle,
            $editMyActicle,
            $deleteMyActicle,
            $viewArticle,

            // permission comment controller
            $viewComment,
            $addComment,
            $editComment,
            $deleteComment,

            // permission user controller
            $viewUser,
            $editUser,
            $deleteUser,
        ]);
        Role::create(['name' => 'user'])->givePermissionTo([
            $viewArticle,

            // permission comment controller
            $viewComment,
            $addComment,
            $editComment,
            $deleteComment,

            // permission user controller
            $viewUser,
            $editUser,
            $deleteUser,
        ]);
    }
}
