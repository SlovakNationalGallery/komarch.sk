<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');

        $this->crud->setColumns([
            [
                'name' => 'title',
                'type' => 'article',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('title->sk', 'like', '%'.$searchTerm.'%')
                          ->orWhere('title->en', 'like', '%'.$searchTerm.'%');
                }
            ],
            [
                'name' => 'published',
                'type' => 'published_at',
            ],
            [
                'name'        => 'tags',
                'label'       => 'Tags',
                'type'        => 'select_multiple',
                'entity'      => 'tags',
                'attribute'   => 'name',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('tag/'.$related_key.'/show');
                    },
                ],
            ],
        ]);

        $this->crud->addFields([
            [
                'name' => 'title',
                'type' => 'text',
            ],
            [
                'name' => 'slug',
                'label' => 'Slug (URL)',
                'type' => 'text',
                'hint' => 'Will be automatically generated from your title, if left empty.'
            ],
            [
                'name' => 'text',
                'type' => 'tinymce',
                'options' => [
                    'entity_encoding' => 'raw',
                    'height' => 480,
                    'plugins' => 'image,link,media,anchor,fullscreen',
                    'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | fullscreen'
                ]
            ],
            [
                'name' => 'published_at',
                'type' => 'datetime_picker',
                'datetime_picker_options' => [
                    'language' => 'sk',
                    'showClear' => true,
                    'stepping' => 30,
                ],
                'wrapper'   => [
                    'class' => 'col-sm-8 col-md-6 form-group',
                ],
            ],
            [
                'name'        => 'tags',
                'label'       => 'Tags',
                'type'        => 'select_multiple',
                'entity'      => 'tags',
                'attribute'   => 'name',
            ],
        ]);

        $this->crud->addFilter([
          'name'  => 'tags',
          'type'  => 'select2',
          'label' => 'Tags'
        ], function() {
            return \Spatie\Tags\Tag::all()->pluck('name', 'id')->toArray();
        }, function ($value) {
            $this->crud->query = $this->crud->query->whereHas('tags', function ($query) use ($value) {
                $query->where('tag_id', $value);
            });
        });

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PostRequest::class);



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'name' => 'text',
            'type' => 'text',
            'escaped' => false,
            'limit' => 10000
        ]);
    }
}
