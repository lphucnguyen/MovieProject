<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $messages = [
            [
                'id' => str()->uuid(),
                'email' => 'user1@app.com',
                'title' => 'user1',
                'message' => 'user1user1user1user1user1user1',
            ],
            [
                'id' => str()->uuid(),
                'email' => 'user2@app.com',
                'title' => 'user2',
                'message' => 'user2user2user2user2user2user2',
            ],
            [
                'id' => str()->uuid(),
                'email' => 'user3@app.com',
                'title' => 'user3',
                'message' => 'user3user3user3user3user3user3',
            ],
        ];

        foreach ($messages as $message) {
            \App\Domain\Models\Message::create($message);
        }
    }
}
