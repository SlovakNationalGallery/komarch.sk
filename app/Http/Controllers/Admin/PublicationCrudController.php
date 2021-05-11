<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PublicationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PublicationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PublicationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Publication::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/publication');
        CRUD::setEntityNameStrings('publication', 'publications');

        $this->crud->setColumns([
            [
                'name' => 'title',
                'type' => 'publication',
            ],
            [
                'name' => 'published',
                'type' => 'published_at',
            ],
            [
                'name' => 'updated_at',
                'type' => 'updated_at',
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
                'name' => 'cover_image',
                'type' => 'browse',
            ],
            [
                'name' => 'description',
                'type' => 'tinymce',
                'options' => [
                    'entity_encoding' => 'raw',
                    'height' => 480
                ]
            ],
            [
                'name' => 'issuu_url',
                'label' => 'Issuu URL',
                'type' => 'url',
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
        ]);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

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
        CRUD::setValidation(PublicationRequest::class);

        // CRUD::setFromDb(); // fields

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
}
