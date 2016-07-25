<?php

namespace App\Console\Commands;

use App\Models\Card;
use Illuminate\Console\Command;

class GenerateCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Playing Cards from alliance members';

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

        //get characters

        $url = "https://evewho.com/api.php?type=allilist&id=99006112&page=";

        $page = 0;
        $characters = [];

        $result = true;

        $this->info('Loading Characters');

        while (true) {
            $data = json_decode(file_get_contents($url . $page));

            if (count($data->characters) == 0)
                break;

            //reindex
            foreach ($data->characters as $char) {
                $characters[] = $char;
            }

            $page++;
        }

        // generate cards

        $this->info('Generating Cards');
        $bar = $this->output->createProgressBar(count($characters));

        foreach ($characters as $index => $character) {
            srand($character->character_id);

            $card = Card::firstOrNew(['name' => $character->name]);
            $card->character_id = $character->character_id;
            $card->corporation_id = $character->corporation_id;
            $card->alliance_id = $character->alliance_id;

            $attack = [];
            $value = 0;

            for ($i = 0; $i <= 3; $i++) {
                $attack[$i] = rand(1, 9);
                $value += $attack[$i];
            }

            $card->attack = implode('|', $attack);

            $haiku = json_decode(file_get_contents('http://dropbearsanonymo.us/api/haiku'));
            $text = $haiku->text . "\n - " . $haiku->authorName;

            $card->text = $text;
            $card->value = $value;


            $card->save();
            $bar->advance();
        }

        $bar->finish();
        $this->info('Finished');
    }
}
