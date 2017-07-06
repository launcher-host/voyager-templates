<?php

use akazorg\VoyagerTemplates\Models\Template as VoyagerTemplate;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use Illuminate\Database\Seeder;
// use TCG\Voyager\Facades\Voyager;

class VoyagerTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedVoyagerTemplates();
        $this->seedBREAD();
    }

    public function seedVoyagerTemplates()
    {
        // Skip if already exists
        if (VoyagerTemplate::first()) {
            return;
        }

        $template = VoyagerTemplate::firstOrNew([
            'name' => 'Columns 8/4',
            'slug' => 'columns-8-4',
        ]);
        $template->fill([
            'view' => implode("\n", [
                '<div class="row">',
                '    <div class="col-sm-8 col-md-8 col-lg-8">@stack("r01_lf")</div>',
                '    <div class="col-sm-4 col-md-4 col-lg-4">@stack("r01_rg")</div>',
                '</div>',
                '<div class="row">',
                '    <div class="col-sm-8 col-md-8 col-lg-8">@stack("r02_lf")</div>',
                '    <div class="col-sm-4 col-md-4 col-lg-4">@stack("r02_rg")</div>',
                '</div>',
            ]),
        ])->save();


        $template = VoyagerTemplate::firstOrNew([
            'name' => 'Columns 6/6',
            'slug' => 'columns-6-6',
        ]);
        $template->fill([
            'view' => implode("\n", [
                '<div class="row">',
                '    <div class="col-sm-6 col-md-6 col-lg-6">@stack("lf")</div>',
                '    <div class="col-sm-6 col-md-6 col-lg-6">@stack("rg")</div>',
                '</div>',
            ]),
        ])->save();


        $template = VoyagerTemplate::firstOrNew([
            'name' => 'Columns 4/8',
            'slug' => 'columns-4-8',
        ]);
        $template->fill([
            'view' => implode("\n", [
                '<div class="row">',
                '    <div class="col-sm-4 col-md-4 col-lg-4">@stack("r01_rg")</div>',
                '    <div class="col-sm-8 col-md-8 col-lg-8">@stack("r01_lf")</div>',
                '</div>',
                '<div class="row">',
                '    <div class="col-sm-4 col-md-4 col-lg-4">@stack("r02_rg")</div>',
                '    <div class="col-sm-8 col-md-8 col-lg-8">@stack("r02_lf")</div>',
                '</div>',
            ]),
        ])->save();
    }

    /**
     * Add BREAD
     */
    public function seedBREAD()
    {
        // Skip if already exists
        if (DataType::where('slug', 'templates')->first()) {
            return;
        }

        $dataType = DataType::firstOrNew(['slug' => 'templates']);

        $dataType->fill([
            'name'                  => 'voyager_templates',
            'display_name_singular' => 'Template',
            'display_name_plural'   => 'Templates',
            'icon'                  => 'voyager-news',
            'model_name'            => 'akazorg\\VoyagerTemplates\\Models\\Template',
            'controller'            => '',
            'generate_permissions'  => 1,
            'description'           => '',
        ])->save();

        /**
         * Add DataRows
         */
        $this->_addDataRow($dataType->id, 'id', [
            'type'         => 'number',
            'display_name' => 'id',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 0,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 1,
        ]);

        $this->_addDataRow($dataType->id, 'name', [
            'type'         => 'text',
            'display_name' => 'Name',
            'required'     => 1,
            'browse'       => 1,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => '',
            'order'        => 2,
        ]);

        $this->_addDataRow($dataType->id, 'slug', [
            'type'         => 'text',
            'display_name' => 'slug',
            'required'     => 1,
            'browse'       => 1,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => json_encode([
                'slugify' => [
                    'origin' => 'name',
                ],
            ]),
            'order' => 3,
        ]);

        $this->_addDataRow($dataType->id, 'view', [
            'type'         => 'code_editor',
            'display_name' => 'body',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => '',
            'order'        => 4,
        ]);

        $this->_addDataRow($dataType->id, 'created_at', [
            'type'         => 'timestamp',
            'display_name' => 'created_at',
            'required'     => 1,
            'browse'       => 1,
            'read'         => 1,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 5,
        ]);

        $this->_addDataRow($dataType->id, 'updated_at', [
            'type'         => 'timestamp',
            'display_name' => 'updated_at',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 0,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 6,
        ]);
    }

    public function _addDataRow($dataTypeId, $field, Array $row)
    {
        $dataRow = DataRow::firstOrNew([
            'data_type_id' => $dataTypeId,
            'field'        => $field
        ]);

        $dataRow->fill($row)->save();
    }
}
