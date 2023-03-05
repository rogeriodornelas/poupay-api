<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class criacao_usuarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teste:criacao_usuarios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Creating user
        $user = new User();
        $user->name = 'Teste 2';
        $user->email = 'email3@email.com';
        $user->email_verified_at = now();
        $user->password = bcrypt('senha123');
        $user->remember_token = Str::random(10);
        $user->provider_name = 'provider';
        $user->provider_id = 1;
        $user->save();

//        // Creating Group 1
//        $group1 = new Group();
//        $group1->name = 'Grupo 1';
//        $group1->description = 'Descrição teste 1';
//        $group1->save();

        // Creating the relationship between groups and users
        $group_user1 = new GroupUser();
        $group_user1->user_id = 3;
        $group_user1->group_id = 1;
        $group_user1->save();
        return Command::SUCCESS;
    }
}
