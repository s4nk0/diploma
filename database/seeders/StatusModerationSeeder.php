<?php

namespace Database\Seeders;

use App\Enums\StatusEnum;
use App\Models\StatusModeration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusModerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id'=>StatusEnum::STATUS_MODERATION_ACCEPTED_ID->value,'title'=>StatusEnum::STATUS_MODERATION_ACCEPTED_TITLE->value],
            ['id'=>StatusEnum::STATUS_MODERATION_PROCESSING_ID->value,'title'=>StatusEnum::STATUS_MODERATION_PROCESSING_TITLE->value],
            ['id'=>StatusEnum::STATUS_MODERATION_NOT_ACCEPTED_ID->value,'title'=>StatusEnum::STATUS_MODERATION_NOT_ACCEPTED_TITLE->value],
        ];

        StatusModeration::insert($data);
    }
}
