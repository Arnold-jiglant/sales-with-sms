<?php

namespace App\Jobs;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Response;

class SendSMSJob
{
    use Dispatchable, Queueable;
    private $recipients;
    private $message;

    /**
     * Create a new job instance.
     *
     * @param $recipients
     * @param $message
     */
    public function __construct($recipients, $message)
    {
        //
        $this->recipients = $recipients;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $http = new \GuzzleHttp\Client();
            $response = $http->request('POST', "https://apisms.beem.africa/v1/send", [
                "headers" => [
//                    'Content-Type' => 'Application/json',
                    'Authorization' => "Basic " . base64_encode(env("BEEM_API_KEY") . ":" . env("BEEM_SECRET"))
                ],
                "json"=>[
                    "source_addr"=>"INFO",
                    "schedule_time"=>"",
                    "encoding"=>"0",
                    "message"=>$this->message,
                    "recipients"=>$this->recipients
                ]
            ]);

            echo $response->getBody();
        }catch (ClientException $exception){
            echo "ERROR STATUS CODE:     ".$exception->getMessage();
        }catch (\Exception $exception){
            echo "ERROR ".$exception->getMessage();
        }

    }
}
