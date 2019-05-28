<?php

use Illuminate\Database\Seeder;
use App\{User,Friend};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      factory(App\User::class, 5)->create(); //genereate users

      //generate friends and messages
      $users = User::all();
      foreach($users as $user){
          $friend               =   new Friend();
          $friend->user_one     =   $user->id;
          $friend->user_two     =   1;
          $friend->save();
            factory(App\Message::class,1)->create([
                'user_id'   => $user->id,
                'friend_id' => $friend->id
            ]);
        }
    }
}
