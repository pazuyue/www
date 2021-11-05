<?php


namespace App\Http\service;


use App\Http\service\InInterface\IChannelService;

class ChannelService implements IChannelService
{
    private $channel_id;
    public function __construct($channel_id)
    {
        $this->channel_id = $channel_id;
    }

    public function addChannel()
    {
        return $this->channel_id;
    }
}
