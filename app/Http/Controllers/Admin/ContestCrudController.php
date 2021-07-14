<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Contest::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contest');
        CRUD::setEntityNameStrings('contest', 'contests');

        $this->crud->setColumns([
            [
                'name' => 'title',
            ],
            [
                'name' => 'subject',
            ],
            [
                'name' => 'contractor_business_name',
            ],
            [
                'name' => 'announced_at',
            ],
            [
                'name' => 'approved_at',
            ],
            [
                'name' => 'finished_at',
            ],
        ]);

        $this->crud->denyAccess('delete');
        $this->crud->denyAccess('update');
        $this->crud->denyAccess('create');
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
}
