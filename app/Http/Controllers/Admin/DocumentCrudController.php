<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DocumentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
// use Spatie\Tags\Tag;

/**
 * Class DocumentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DocumentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Document::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/document');
        CRUD::setEntityNameStrings('document', 'documents');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        CRUD::setColumns([
            [
                'name' => 'name',
            ],
            [
                'name' => 'types',
                'type' => 'relationship',
                'entity' => 'types',
                'attribute' => 'name',
            ],
            [
                'name' => 'roles',
                'type' => 'relationship',
                'entity' => 'roles',
                'attribute' => 'name',
            ],
            [
                'name' => 'file',
                'type'     => 'closure',
                'function' => function($entry) {
                    return ($entry->file) ?  $entry->file->file_name : '';
                }
            ],
            [
                'name' => 'download_count',
                'type'     => 'number',
                'searchLogic' => false,
            ],
            [
                'name' => 'creator',
                'type' => 'relationship',
                'entity' => 'creator',
                'attribute' => 'name',
                'orderLogic' => function ($query, $column, $columnDirection) {
                        return $query->leftJoin('users', 'users.id', '=', 'projects.select')
                            ->orderBy('users.name', $columnDirection)->select('projects.*');
                },
                'searchLogic' => function ($query, $column, $searchTerm) {
                        $query->orWhereHas('creator', function ($q) use ($column, $searchTerm) {
                            $q->where('name', 'like', '%'.$searchTerm.'%');
                        });
                    }
            ],
        ]);

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
        CRUD::setValidation(DocumentRequest::class);

        // CRUD::setFromDb(); // fields

        CRUD::addFields([
            [
                'name' => 'name',
                'type' => 'text',
            ],
            [
                'name' => 'file',
                'label' => 'File',
                'type'  => 'upload_media',
                'upload' => true,
            ],
            [
                'name'        => 'types',
                'type'        => 'select2_multiple_tags',
                'entity'      => 'types',
                'attribute'   => 'name',
                'fake'     => true,
                'attributes' => [
                    'data-tags' => true
                ],
                'options'   => (function ($query) {
                    return $query->where('type', 'document-type')->get();
                }),
            ],
            [
                'name'        => 'topics',
                'type'        => 'select2_multiple_tags',
                'entity'      => 'topics',
                'attribute'   => 'name',
                'fake'     => true,
                'attributes' => [
                    'data-tags' => true
                ],
                'options'   => (function ($query) {
                    return $query->where('type', 'document-topic')->get();
                }),
            ],
            [
                'name'        => 'roles',
                'type'        => 'select2_multiple_tags',
                'entity'      => 'roles',
                'attribute'   => 'name',
                'fake'     => true,
                'attributes' => [
                    'data-tags' => true
                ],
                'options'   => (function ($query) {
                    return $query->where('type', 'document-role')->get();
                }),
            ],
        ]);

    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->setColumns([
            [
                'name' => 'name',
            ],
            [
                'name' => 'types',
                'type' => 'relationship',
                'entity' => 'types',
                'attribute' => 'name',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('tag/'.$related_key.'/show');
                    },
                ],

            ],
            [
                'name' => 'topics',
                'type' => 'relationship',
                'entity' => 'topics',
                'attribute' => 'name',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('tag/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'name' => 'roles',
                'type' => 'relationship',
                'entity' => 'roles',
                'attribute' => 'name',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('tag/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'name' => 'file',
                'type'     => 'closure',
                'function' => function($entry) {
                    return ($entry->file) ?  $entry->file->file_name : '';
                },
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return ($entry->file) ?  $entry->file->getFullUrl() : '';
                    },
                ],
            ],
            [
                'name' => 'download_count',
                'type'     => 'number',
                'searchLogic' => false,
            ],
            [
                'name' => 'creator',
                'type' => 'relationship',
                'entity' => 'creator',
                'attribute' => 'name',
            ],
            [
                'name' => 'updator',
                'type' => 'relationship',
                'entity' => 'updator',
                'attribute' => 'name',
            ],
        ]);
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

    public function store()
    {
        $response = $this->traitStore();
        $this->syncAllTags($this->crud->getCurrentEntry());
        return $response;
    }

    public function update()
    {
        $response = $this->traitUpdate();
        $this->syncAllTags($this->crud->getCurrentEntry());
        return $response;
    }

    private function syncAllTags(\Illuminate\Database\Eloquent\Model $entry)
    {
        $entry->syncTagsWithType($this->crud->getRequest()->input('types', []), 'document-type');
        $entry->syncTagsWithType($this->crud->getRequest()->input('topics', []), 'document-topic');
        $entry->syncTagsWithType($this->crud->getRequest()->input('roles', []), 'document-role');
    }
}
