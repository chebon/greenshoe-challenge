<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class GreenshoeInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'greenshoe:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To initial the project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'user1',
            'slug' => 'user1',
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'user2',
            'slug' => 'user2',
        ]);

        $role = Sentinel::findRoleByName('user1');
        $role->addPermission('list.search')->save();

        $role = Sentinel::findRoleByName('user2');
        $role->addPermission('user.access');
        $role->addPermission('list.view');
        $role->addPermission('list.search');
        $role->addPermission('list.export')->save();

    }
}
