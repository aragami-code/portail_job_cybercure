<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'users']);

        $permissions = [


            [
                'group_name'=>'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dasboard.edit'
                    ]
            ],
            [
            'group_name'=>'blog',
            'permissions' => [
            //blog permission
        	'blog.create',
        	'blog.view',
        	'blog.edit',
        	'blog.delete',
        	'blog.approve',

                    ]
            ],


            [
                'group_name'=>'admin',
                'permissions' =>
                    [
                    //admin permission
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',

                    ]

            ],


            [
                'group_name'=>'role',
                'permissions' =>
                    [
                    //role permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',

                    ]

            ],

            [
                'group_name'=>'bcategorie',
                'permissions' =>
                    [
                    //categorie blog permission
                    'bcategorie.create',
                    'bcategorie.view',
                    'bcategorie.edit',
                    'bcategorie.delete',


                    ]

            ],

            [
                'group_name'=>'article',
                'permissions' =>
                    [
                    //article permission
                    'article.create',
                    'article.view',
                    'article.edit',
                    'article.delete',


                    ]

            ],

            [
                'group_name'=>'type_emploi',
                'permissions' =>
                    [
                    //type_emploi permission
                    'typemp.create',
                    'typemp.view',
                    'typemp.edit',
                    'typemp.delete',


                    ]

            ],

            [
                'group_name'=>'type_contrat',
                'permissions' =>
                    [
                    //type_contrat permission
                    'type_contrat.create',
                    'type_contrat.view',
                    'type_contrat.edit',
                    'type_contrat.delete',


                    ]

            ],

            [
                'group_name'=>'type_formation',
                'permissions' =>
                    [
                    //type_formation permission
                    'type_formation.create',
                    'type_formation.view',
                    'type_formation.edit',
                    'type_formation.delete',


                    ]

            ],

            [
                'group_name'=>'plage_salaire',
                'permissions' =>
                    [
                    //salaire permission
                    'salaire.create',
                    'salaire.view',
                    'salaire.edit',
                    'salaire.delete',


                    ]

            ],

            [
                'group_name'=>'secteur_activite',
                'permissions' =>
                    [
                    //role permission
                    'sectA.create',
                    'sectA.view',
                    'sectA.edit',
                    'sectA.delete',


                    ]

            ],

            [
                'group_name'=>'Etats',
                'permissions' =>
                    [
                    //role permission
                    'GLE.create',
                    'GLE.view',
                    'GLE.edit',
                    'GLE.delete',


                    ]

            ],

            [
                'group_name'=>'Regions',
                'permissions' =>
                    [
                    //role permission
                    'GLR.create',
                    'GLR.view',
                    'GLR.edit',
                    'GLR.delete',


                    ]

            ],

            [
                'group_name'=>'Villes',
                'permissions' =>
                    [
                    //role permission
                    'GLV.create',
                    'GLV.view',
                    'GLV.edit',
                    'GLV.delete',


                    ]

            ],

            [
                'group_name'=>'Emploi_Postuler',
                'permissions' =>
                    [
                    //role permission
                    'Emploi_Postuler.view',
                    'Emploi_Postuler.mail',
                    'Emploi_Postuler.interview',
                    'Emploi_Postuler.contacter',
                    'Emploi_Postuler.shortlist',


                    ]

            ],




            [
                'group_name'=>'profile',
                'permissions' =>
                    [
                    //profile permission
                    'profile.view',
                    'profile.edit',

                    ]

            ],

            [
                'group_name'=>'Parametre_Site',
                'permissions' =>
                    [
                    //profile permission
                    'Parametre.view',
                    'Parametre.edit',

                    ]

            ],

            [
                'group_name'=>'newsletter',
                'permissions' =>
                    [
                    //role permission
                    'NL.create',
                    'NL.view',
                    'NL.edit',
                    'NL.delete',


                    ]

            ],



        ];

        //

        for($i=0; $i < count($permissions); $i++){

            // create permission

            $permissionGroup = $permissions[$i]['group_name'];

            for($j = 0; $j < count($permissions[$i]['permissions']); $j++){

                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }



        }
    }
}
