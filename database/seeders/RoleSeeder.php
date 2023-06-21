<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Empresa']);
        $role3 = Role::create(['name' => 'Usuario']);



        //Permiso admin Dashboard
        Permission::create([
            'name' => 'admin.dashboard',
            'description'=> 'Ver dashboard del Admin y Empresa'
        ])->syncRoles([$role1, $role2]);



        //Permisos admin Estados
        Permission::create([
            'name' => 'admin.states.index',
            'description'=> 'Lista de Estados Disponibles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.create',
            'description'=> 'Creacion de Estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.edit',
            'description'=> 'Edicion de Estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.show',
            'description'=> 'Ver detalles de Estado'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.destroy',
            'description'=> 'Eliminar Estados'
        ])->syncRoles([$role1]);


        //Permisos admin Roles
        Permission::create([
            'name' => 'admin.roles.index',
            'description'=> 'Lista de Estados Disponibles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.create',
            'description'=> 'Creacion de Estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.edit',
            'description'=> 'Edicion de Estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.show',
            'description'=> 'Ver detalles de Estado'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.destroy',
            'description'=> 'Eliminar Estados'
        ])->syncRoles([$role1]);



        //Permisos admin Usuarios
        Permission::create([
            'name' => 'admin.users.index',
            'description'=> 'Lista de Usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.create',
            'description'=> 'Creacion de Usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.edit',
            'description'=> 'Edicion de Usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.show',
            'description'=> 'Ver detalles de Usuario'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.destroy',
            'description'=> 'Eliminar Usuario'
        ])->syncRoles([$role1]);


        //Permisos Admin Productos
        Permission::create([
            'name' => 'admin.products.index',
            'description'=> 'Lista de Productos'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin.products.create',
            'description'=> 'Crear Producto'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin.products.edit',
            'description'=> 'Editar Producto'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin.products.show',
            'description'=> 'Ver detalles del Producto'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin.products.destroy',
            'description'=> 'Eliminar Producto'
        ])->syncRoles([$role1, $role2]);


        //Permisos admin Pagos
        Permission::create([
            'name' => 'admin.pays.index',
            'description'=> 'Lista de metodos de Pago'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.pays.create',
            'description'=> 'Crear metodos de pago'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.pays.edit',
            'description'=> 'editar metodo de pago'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.pays.show',
            'description'=> 'ver metodo de pago'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.pays.destroy',
            'description'=> 'eliminar metodo de pago'
        ])->syncRoles([$role1]);


        //Permisos admin Reporte ventas
        Permission::create([
            'name' => 'admin.salereports.index',
            'description'=> 'Listar reporte de ventas'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin.salereports.create',
            'description'=> 'Crear reporte de venta'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin.salereports.edit',
            'description'=> 'Editar reporte de venta'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin.salereports.show',
            'description'=> 'Ver detalle del reporte de venta'
        ])->syncRoles([$role1, $role2]);
        Permission::create([
            'name' => 'admin.salereports.destroy',
            'description'=> 'Eliminar reporte de venta'
        ])->syncRoles([$role1, $role2]);


        //Permisos Admin Empresas
        Permission::create([
            'name' => 'admin.companies.index',
            'description'=> 'Lista de empresas'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.companies.create',
            'description'=> 'Crear empresa'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.companies.edit',
            'description'=> 'Editar empresa'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'admin.companies.show',
            'description'=> 'Ver detalle de la empresa'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.companies.destroy',
            'description'=> 'Eliminar empresa'
        ])->syncRoles([$role1]);

        //Permisos Admin Pedidios anticipados
        Permission::create([
            'name' => 'admin.preorders.index',
            'description'=> 'Lista de pedidos pendientes'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'admin.preorders.entregados',
            'description'=> 'Lista de pedidos entregados'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'admin.preorders.create',
            'description'=> 'Crear un pedido anticipado'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'admin.preorders.edit',
            'description'=> 'Editar de pedidos pendientes'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'admin.preorders.show',
            'description'=> 'Ver detalles de pedidos pendientes'
        ])->syncRoles([$role1,$role2]);
        Permission::create([
            'name' => 'admin.preorders.destroy',
            'description'=> 'Eliminar pedidos pendientes'
        ])->syncRoles([$role1]);
    }
}
