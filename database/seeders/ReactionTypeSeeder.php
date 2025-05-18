<?php

namespace Database\Seeders;

use App\Domain\Enums\ReactionTypeEnum;
use App\Domain\Models\ReactionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reactionTypes = DB::table('reaction_types')->select('*')->get();
        foreach (ReactionTypeEnum::cases() as $reactionTypeEnum){
            $updates = [];
            $exists = false;
            foreach ($reactionTypes as $reactionType){
                if ($reactionType->name === $reactionTypeEnum->name){
                    if ($reactionType->label !== $reactionTypeEnum->value){
                        $updates['label'] = $reactionType->label;
                    }
                    if ($reactionType->is_active !== $reactionTypeEnum->is_active()){
                        $updates['is_active'] = $reactionTypeEnum->is_active();
                    }
                    $exists = true;
                    break;
                }
            }

            if (!$exists){
                DB::table('reaction_types')->insert([
                    'name' => $reactionTypeEnum->name,
                    'label' => $reactionTypeEnum->value,
                    'is_active' => $reactionTypeEnum->is_active(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }else if (!empty($updates)){
                $updates['updated_at'] = now();
                DB::table('reaction_types')->where('name', '=', $reactionTypeEnum->name)
                    ->update($updates);
            }
        }
    }
}
