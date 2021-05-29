<?php
/**
 * Created by PhpStorm.
 * User: mm_20
 * Date: 20/09/2020
 * Time: 02:39
 */

namespace App\Traits;


trait GeneralAttribute
{
    public $status = 1;
    public $search_name ='';
    public $page_title = '';
    public $single_object = '';
    public $button_type = 'Save';

    public $permissions =[
        ['name'=>'Delegates','permissions'=>[
            'view-delegates','add-delegates','edit-delegates','delete-delegates']

        ],
        ['name'=>'Customers','permissions'=>
            [
                'view-customers',
                'add-customers',
                'edit-customers',
                'delete-customers'
            ]

        ],
        ['name'=>'Questions','permissions'=>
            [
                'view-questions',
                'add-questions',
                'edit-questions',
                'delete-questions'
            ]

        ],
        ['name'=>'Documents','permissions'=>
            [
                'view-documents',
                'add-documents',
                'edit-documents',
                'delete-documents'
            ]

        ],
        ['name'=>'User','permissions'=>
            [
                'view-user',
                'add-user',
                'edit-user',
                'delete-user'
            ]

        ],
        ['name'=>'Area','permissions'=>
            [
                'view-area',
                'add-area',
                'edit-area',
                'delete-area'
            ]

        ],  ['name'=>'City','permissions'=>
            [
                'view-city',
                'add-city',
                'edit-city',
                'delete-city'
            ]

        ],
        ['name'=>'Settings','permissions'=>
            [
                'view-setting',
                'add-setting',
                'edit-setting',
                'delete-setting'
            ]

        ],
    ];

}