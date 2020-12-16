<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Tag::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tag');
        CRUD::setEntityNameStrings('tag', 'tags');

        $this->crud->addColumns([
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'slug',
                'label' => 'Slug',
                'type' => 'text',
            ],
            [
                'name' => 'type',
                'label' => 'Type',
                'type' => 'text',
            ],
            [
                'name' => 'order_column',
                'label' => 'Order Column',
                'type' => 'number',
            ],
            [
                'name' => 'created_at',
                'label' => 'Created At',
                'type' => 'datetime',
            ],
            [
                'name' => 'updated_at',
                'label' => 'Updated At',
                'type' => 'datetime',
            ],
            [
                'name'        => 'posts',
                'label'       => 'Posts',
                'type'        => 'select_multiple',
                'entity'      => 'posts',
                'attribute'   => 'title',
                'model'       => 'App\Models\Post',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('post/'.$related_key.'/show');
                    },
                ],
            ],
        ]);

        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'slug',
                'label' => 'Slug',
                'type' => 'text',
            ],
            [
                'name' => 'type',
                'label' => 'Type',
                'type' => 'text',
            ],
            [
                'name' => 'order_column',
                'label' => 'Order Column',
                'type' => 'number',
            ],
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TagRequest::class);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TagRequest::class);
    }
}
