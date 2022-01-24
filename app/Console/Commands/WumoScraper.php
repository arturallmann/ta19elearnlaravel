<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class WumoScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:wumo';

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
        $url = 'https://wumo.com/wumo';
        $i = 0;
        while($i<10) {
            $body = $this->getOrCache($url, $guzzle);
            //var_dump($body);
            $crawler = new Crawler($body);
            $imgEl = $crawler->filter('img')->eq(0);
            var_dump([
                'img' => $imgEl->attr('src')
            ]);
            $prevEl = $crawler->filter('a.prev');
            $url = 'https://wumo.com' . $prevEl->attr('href');
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
