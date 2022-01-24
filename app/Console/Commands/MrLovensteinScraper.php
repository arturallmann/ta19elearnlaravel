<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class MrLovensteinScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:mrlovenstein';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $guzzle = new Client();
        $i = 2;
        while($i<1168) {

            $body = $this->getOrCache("https://www.mrlovenstein.com/comic/{$i}#comic", $guzzle);
            //var_dump($body);
            $crawler = new Crawler($body);
            $img = $crawler->filter('#comic_main_image>img');
            var_dump([
                'img' => $img->attr('src'),
                'alt' => $img->attr('alt')

            ]);

            $i++;
            //sleep(1);
        }
    }
        public function getOrCache($url, Client $guzzle){
        if(Cache::has($url)){
            return Cache::get($url);
        }
        $response = $guzzle->get($url);
        //echo "made a request";
        $body = $response->getBody()->getContents();
        Cache::put($url, $body);
        return $body;
    }

}
