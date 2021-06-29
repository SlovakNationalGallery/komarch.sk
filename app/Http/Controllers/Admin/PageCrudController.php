<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Page;
/**
 * Class PageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Page::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/page');
        CRUD::setEntityNameStrings('page', 'pages');

        $this->crud->setColumns([
            [
                'name' => 'title',
                'type' => 'title_with_preview',
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
                'name'        => 'parent',
                'label'       => 'Parent',
                'type'        => 'select',
                'entity'      => 'parent',
                'attribute'   => 'title',
                'orderable' => true,
                'orderLogic' => function ($query, $column, $columnDirection) {
                        return $query->orderBy('parent_id', $columnDirection);
                    },
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('page/'.$related_key.'/show');
                    },
                ],
            ],
            [
                'name' => 'menu_order',
                'type' => 'text',
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
                'name' => 'redirect_url',
                'type' => 'text',
                'hint' => 'Only if this page should redirect to other URL'
            ],
            [
                'name'        => 'parent_id',
                'label'       => 'Parent',
                'type'        => 'select2_custom_nested',
                'entity'      => 'parent',
                'attribute'   => 'title',
            ],
            [
                'name' => 'menu_order',
                'type' => 'number',
                'hint' => 'Leave empty to hide from navigation'
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
                'type'        => 'select2_multiple',
                'entity'      => 'tags',
                'attribute'   => 'name',
            ],
            [
                'name' => 'cover_image',
                'label' => 'Cover image',
                'type'  => 'upload_media',
                'upload' => true,
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

        $this->crud->addFilter([
          'name'  => 'parent_id',
          'type'  => 'select2_wide',
          'label' => 'Parent page'
        ], function() {
            return \App\Models\Page::getTree($only_parents = true);
        }, function($value) {
            $this->crud->addClause('where', 'parent_id', $value);
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
        $this->crud->addButtonFromView('line', 'show_online', 'show_online', 'beginning');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PageRequest::class);



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
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumn([
            'name' => 'url',
            'type' => 'text',
            'wrapper'   => [
                'href' => function ($crud, $column, $entry, $related_key) {
                  return $entry->url;
                },
                'target' => '_blank',
            ],
        ]);

        $this->crud->addColumn([
            'name' => 'breadcrumbs',
            'type' => 'breadcrumbs',
        ]);

        $this->crud->addColumn([
            'name' => 'text',
            'type' => 'html',
            'escaped' => false,
            'limit' => 100000
        ]);
        $this->crud->addColumn([
            'name'        => 'children',
            'label'       => 'Children',
            'type'        => 'select_multiple',
            'entity'      => 'children',
            'attribute'   => 'title',
            'wrapper'   => [
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('page/'.$related_key.'/show');
                },
            ],
        ]);
    }

    public function update()
    {
        if ($this->crud->getRequest()->input('menu_order') !== null) {
            $this->shiftPages($this->crud->getCurrentEntry());
        }
        $this->reorderPages($this->crud->getCurrentEntry());
        $response = $this->traitUpdate();
        return $response;
    }

    private function reorderPages($page)
    {
        $pages = Page::where('parent_id', $page->parent_id)->menu()->get();
        foreach ($pages as $i => $page) {
            $page->menu_order = $i;
            $page->save();
        }
    }

    private function shiftPages($page)
    {
        $pages = Page::menu()->where('parent_id', $page->parent_id)->where('menu_order', '>=', $page->menu_order)->get();
        foreach ($pages as $i => $page) {
            $page->menu_order++;
            $page->save();
        }
    }
}
