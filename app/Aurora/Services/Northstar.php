<?php namespace Aurora\Services\Northstar;

class NorthstarAPI {

  protected $client;

  public function __construct()
  {
    // $base_url = ;
    $client = new \GuzzleHttp\Client([
      'base_url' => \Config::get('northstar.url') . '/' .  \Config::get('version'),
    ]);
  }

  }
}

