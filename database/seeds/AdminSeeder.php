<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空数据表
        Admin::truncate();
        //生成数据表
        factory(Admin::class,20)->create();
        //修改id为6的数据用户名为admin
        Admin::where('id',6)->update(['username'=>'admin']);
    }
}
